<?php
namespace Kerox\Fcm\Response;

use GuzzleHttp\Psr7\Response;

class GroupResponse extends BaseResponse
{

    const FAILED_REGISTRATION_IDS = "failed_registration_ids";

    /**
     * @var string
     */
    protected $group;

    /**
     * @var int
     */
    protected $numberTargetsSuccess = 0;

    /**
     * @var int
     */
    protected $numberTargetsFailure = 0;

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
     * Getter for numberTargetsSuccess
     *
     * @return int
     */
    public function getNumberTargetsSuccess(): int
    {
        return $this->numberTargetsSuccess;
    }

    /**
     * Getter for numberTargetsFailure
     *
     * @return int
     */
    public function getNumberTargetsFailure(): int
    {
        return $this->numberTargetsFailure;
    }

    /**
     * Getter for targetsFailed
     *
     * @return array
     */
    public function getTargetsFailed(): array
    {
        return $this->targetsFailed;
    }

    /**
     * @param array $response
     * @return void
     */
    protected function parseResponse(array $response)
    {
        $this->parse($response);

        if ($this->needFailedParsing($response)) {
            $this->parseFailed($response);
        }
    }

    /**
     * @param array $response
     * @return void
     */
    protected function parse($response)
    {
        if (isset($response[self::SUCCESS])) {
            $this->numberTargetsSuccess = $response[self::SUCCESS];
        }

        if (isset($response[self::FAILURE])) {
            $this->numberTargetsFailure = $response[self::FAILURE];
        }
    }

    /**
     * @param array $response
     * @return bool
     */
    protected function needFailedParsing($response): bool
    {
        return (isset($response[self::FAILED_REGISTRATION_IDS]) && $this->numberTargetsFailure > 0);
    }

    /**
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