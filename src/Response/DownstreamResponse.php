<?php
namespace Kerox\Fcm\Response;

use GuzzleHttp\Psr7\Response;

/**
 * Class DownstreamResponse
 * @package Kerox\Fcm\Response
 */
class DownstreamResponse extends BaseResponse
{

    const MULTICAST_ID = 'multicast_id';
    const CANONICAL_IDS = 'canonical_ids';
    const RESULTS = 'results';

    const MESSAGE_ID = 'message_id';
    const REGISTRATION_ID = 'registration_id';

    const MISSING_REGISTRATION = 'MissingRegistration';
    const INVALID_REGISTRATION = 'InvalidRegistration';
    const NOT_REGISTERED = 'NotRegistered';
    const UNAVAILABLE = 'Unavailable';
    const DEVICE_MESSAGE_RATE_EXCEEDED = 'DeviceMessageRateExceeded';
    const INTERNAL_SERVER_ERROR = 'InternalServerError';

    /**
     * Number of results that contain a canonical registration token.
     *
     * @var int
     */
    protected $numberModify = 0;

    /**
     * List of targets to modify.
     *
     * @var array
     */
    protected $targetsToModify = [];

    /**
     * List of targets to delete.
     *
     * @var array
     */
    protected $targetsToDelete = [];

    /**
     * List of targets to retry.
     *
     * @var array
     */
    protected $targetsToRetry = [];

    /**
     * List of targets with error.
     *
     * @var array
     */
    protected $targetsWithError = [];

    /**
     * Set to true if no targets was passed to the request.
     *
     * @var bool
     */
    protected $hasMissingToken = false;

    /**
     * List of targets.
     *
     * @var string|array
     */
    private $targets;

    /**
     * DownstreamResponse constructor.
     *
     * @param \GuzzleHttp\Psr7\Response $response Response of the request.
     * @param string|array $targets List of targets inside the request.
     */
    public function __construct(Response $response, $targets)
    {
        $this->targets = (array)$targets;

        parent::__construct($response);
    }

    /**
     * Getter for numberSuccess.
     *
     * @return int
     */
    public function getNumberSuccess(): int
    {
        return $this->numberSuccess;
    }

    /**
     * Getter for numberFailure.
     *
     * @return int
     */
    public function getNumberFailure(): int
    {
        return $this->numberFailure;
    }

    /**
     * Getter for numberModify.
     *
     * @return int
     */
    public function getNumberModify(): int
    {
        return $this->numberModify;
    }

    /**
     * Setter for numberModify.
     *
     * @param $response
     */
    protected function setNumberModify($response)
    {
        if (isset($response[self::CANONICAL_IDS])) {
            $this->numberModify = $response[self::CANONICAL_IDS];
        }
    }

    /**
     * Getter for targetsToModify.
     *
     * @return array
     */
    public function getTargetsToModify(): array
    {
        return $this->targetsToModify;
    }

    /**
     * Getter for targetsToDelete.
     *
     * @return array
     */
    public function getTargetsToDelete(): array
    {
        return $this->targetsToDelete;
    }

    /**
     * Getter for targetsToRetry.
     *
     * @return array
     */
    public function getTargetsToRetry(): array
    {
        return $this->targetsToRetry;
    }

    /**
     * Getter for targetsWithError.
     *
     * @return array
     */
    public function getTargetsWithError(): array
    {
        return $this->targetsWithError;
    }

    /**
     * Getter for hasMissingToken.
     *
     * @return bool
     */
    public function hasMissingToken(): bool
    {
        return $this->hasMissingToken;
    }

    /**
     * Parse the response of the request.
     *
     * @param array $response Response of the request.
     * @return void
     */
    protected function parseResponse(array $response)
    {
        $this->setNumberSuccess($response);
        $this->setNumberFailure($response);
        $this->setNumberModify($response);

        if ($this->needResultParsing($response)) {
            $this->parseResult($response);
        }
    }

    /**
     * Parse the results of the request.
     *
     * @param array $response Response of the request.
     * @return void
     */
    private function parseResult(array $response)
    {
        foreach ($response[self::RESULTS] as $index => $result) {
            if (!$this->isSent($result)) {
                if (!$this->needToBeModify($index, $result)) {
                    if (!$this->needToBeDeleted($index, $result)
                        && !$this->needToBeResent($index, $result)
                        && !$this->checkMissingToken($result)
                    ) {
                        $this->needToAddError($index, $result);
                    }
                }
            }
        }
    }

    /**
     * Determine if the results of the request need to be parsed.
     *
     * @param array $response Response of the request.
     * @return bool
     */
    private function needResultParsing(array $response): bool
    {
        return (($this->numberFailure > 0 || $this->numberModify > 0)
            && isset($response[self::RESULTS]));
    }

    /**
     * Check if the notification was sent.
     *
     * @param array $result Result for a specific token.
     * @return bool
     */
    private function isSent(array $result): bool
    {
        return (isset($result[self::MESSAGE_ID]) && !isset($result[self::REGISTRATION_ID]));
    }

    /**
     * Check if a token need to be updated.
     *
     * @param int $index Index of the result.
     * @param array $result Result for a specific token.
     * @return bool
     */
    private function needToBeModify(int $index, array $result): bool
    {
        if (isset($result[self::MESSAGE_ID]) && isset($result[self::REGISTRATION_ID])) {
            if ($this->targets[$index]) {
                $this->targetsToModify[$this->targets[$index]] = $result[self::REGISTRATION_ID];
            }

            return true;
        }

        return false;
    }

    /**
     * Check if a token need to be deleted.
     *
     * @param int $index Index of the result.
     * @param array $result Result for a specific token.
     * @return bool
     */
    private function needToBeDeleted(int $index, array $result): bool
    {
        if (isset($result[self::ERROR])
            && (in_array(self::NOT_REGISTERED, $result) || in_array(self::INVALID_REGISTRATION, $result))
        ) {
            if ($this->targets[$index]) {
                $this->targetsToDelete[] = $this->targets[$index];
            }

            return true;
        }

        return false;
    }

    /**
     * Check if the notification need to be resent to a specific token.
     *
     * @param int $index Index of the result.
     * @param array $result Result for a specific token.
     * @return bool
     */
    private function needToBeResent(int $index, array $result): bool
    {
        if (isset($result[self::ERROR])
            && (in_array(self::UNAVAILABLE, $result)
                || in_array(self::DEVICE_MESSAGE_RATE_EXCEEDED, $result)
                || in_array(self::INTERNAL_SERVER_ERROR, $result))
        ) {
            if ($this->targets[$index]) {
                $this->targetsToRetry[] = $this->targets[$index];
            }

            return true;
        }

        return false;
    }

    /**
     * Check if the push has targets.
     *
     * @param array $result Result for a specific token.
     * @return bool
     */
    private function checkMissingToken(array $result): bool
    {
        $hasMissingToken = (isset($result[self::ERROR]) && isset($result[self::MISSING_REGISTRATION]));
        $this->hasMissingToken = (boolean)($this->hasMissingToken || $hasMissingToken);

        return $hasMissingToken;
    }

    /**
     * Check if the notification for a specific token has error.
     *
     * @param int $index Index of the result.
     * @param array $result Result for a specific token.
     * @return void
     */
    private function needToAddError(int $index, array $result)
    {
        if (isset($result[self::ERROR])) {
            if ($this->targets[$index]) {
                $this->targetsWithError[$this->targets[$index]] = $result[self::ERROR];
            }
        }
    }

    /**
     * Merge response when a push notification is send to more than 1000 targets.
     *
     * @param \Kerox\Fcm\Response\DownstreamResponse $response
     * @return void
     */
    public function merge(DownstreamResponse $response)
    {
        $this->numberSuccess += $response->getNumberSuccess();
        $this->numberFailure += $response->getNumberFailure();
        $this->numberModify += $response->getNumberModify();

        $this->targetsToDelete = array_merge($this->targetsToDelete, $response->getTargetsToDelete());
        $this->targetsToModify = array_merge($this->targetsToModify, $response->getTargetsToModify());
        $this->targetsToRetry = array_merge($this->targetsToRetry, $response->getTargetsToRetry());
        $this->targetsWithError = array_merge($this->targetsWithError, $response->getTargetsWithError());
    }
}
