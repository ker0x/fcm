<?php
namespace ker0x\Fcm\Response;

use GuzzleHttp\Psr7\Response;

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
     * Number of targets that have successfully received the notification
     *
     * @var int
     */
    protected $numberTargetsSuccess = 0;

    /**
     * Number of messages that could not be processed.
     *
     * @var int
     */
    protected $numberTargetsFailure = 0;

    /**
     * Number of results that contain a canonical registration token.
     *
     * @var int
     */
    protected $numberTargetsModify = 0;

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
     * Getter for numberTargetsSuccess.
     *
     * @return int
     */
    public function getNumberTargetsSuccess(): int
    {
        return $this->numberTargetsSuccess;
    }

    /**
     * Getter for numberTargetsFailure.
     *
     * @return int
     */
    public function getNumberTargetsFailure(): int
    {
        return $this->numberTargetsFailure;
    }

    /**
     * Getter for numberTargetsModify.
     *
     * @return int
     */
    public function getNumberTargetsModify(): int
    {
        return $this->numberTargetsModify;
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
        $this->parse($response);

        if ($this->needResultParsing($response)) {
            $this->parseResult($response);
        }
    }

    /**
     * Multiple setter.
     *
     * @param array $response
     * @return void
     */
    private function parse(array $response)
    {
        if (isset($response[self::SUCCESS])) {
            $this->numberTargetsSuccess = $response[self::SUCCESS];
        }

        if (isset($response[self::FAILURE])) {
            $this->numberTargetsFailure = $response[self::FAILURE];
        }

        if (isset($response[self::CANONICAL_IDS])) {
            $this->numberTargetsModify = $response[self::CANONICAL_IDS];
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
        return (isset($response[self::RESULTS]) && ($this->numberTargetsFailure > 0 || $this->numberTargetsModify > 0));
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
     * @param \ker0x\Fcm\Response\DownstreamResponse $response
     * @return void
     */
    public function merge(DownstreamResponse $response)
    {
        $this->numberTargetsSuccess += $response->getNumberTargetsSuccess();
        $this->numberTargetsFailure += $response->getNumberTargetsFailure();
        $this->numberTargetsModify += $response->getNumberTargetsModify();

        $this->targetsToDelete = array_merge($this->targetsToDelete, $response->getTargetsToDelete());
        $this->targetsToModify = array_merge($this->targetsToModify, $response->getTargetsToModify());
        $this->targetsToRetry = array_merge($this->targetsToRetry, $response->getTargetsToRetry());
        $this->targetsWithError = array_merge($this->targetsWithError, $response->getTargetsWithError());
    }
}