<?php
namespace Kerox\Fcm\Response;

use GuzzleHttp\Psr7\Response;

/**
 * Class GroupResponse
 * @package Kerox\Fcm\Response
 */
class GroupResponse extends BaseResponse
{

    const FAILED_REGISTRATION_IDS = "failed_registration_ids";

    /**
     * @var string
     */
    protected $group;

    /**
     * @var array
     */
    protected $targetsFailed;

    /**
     * GroupResponse constructor.
     *
     * @param \GuzzleHttp\Psr7\Response $response
     * @param string $group
     */
    public function __construct(Response $response, $group)
    {
        $this->group = $group;

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
     * Getter for targetsFailed.
     *
     * @return array
     */
    public function getTargetsFailed(): array
    {
        return $this->targetsFailed;
    }

    /**
     * @inheritdoc
     *
     * @param array $response
     * @return void
     */
    protected function parseResponse(array $response)
    {
        $this->setNumberSuccess($response);
        $this->setNumberFailure($response);

        if ($this->needFailedParsing($response)) {
            $this->parseFailed($response);
        }
    }

    /**
     * Check if the response has failed registration_ids
     *
     * @param array $response
     * @return bool
     */
    protected function needFailedParsing($response): bool
    {
        return (isset($response[self::FAILED_REGISTRATION_IDS]) && $this->numberFailure > 0);
    }

    /**
     * Return all registration_ids that failed during the request.
     *
     * @param array $response
     * @return void
     */
    protected function parseFailed($response)
    {
        if (isset($response[self::FAILED_REGISTRATION_IDS])) {
            foreach ($response[self::FAILED_REGISTRATION_IDS] as $target) {
                $this->targetsFailed[] = $target;
            }
        }
    }
}
