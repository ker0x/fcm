<?php
namespace Kerox\Fcm\Request;

/**
 * Class BaseRequest
 * @package Kerox\Fcm\Request
 */
abstract class BaseRequest
{

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var null|string
     */
    protected $senderId;

    /**
     * BaseRequest constructor.
     *
     * @param null|string $apiKey
     * @param string $senderId
     */
    public function __construct(string $apiKey, string $senderId = null)
    {
        $this->apiKey = $apiKey;
        $this->senderId = $senderId;
    }

    /**
     * Build the header for the request.
     *
     * @return array
     */
    protected function buildRequestHeader(): array
    {
        $headers = [
            'Authorization' => 'key=' . $this->apiKey,
            'Content-Type' => 'application/json',
            'project_id' => $this->senderId,
        ];

        return array_filter($headers);
    }

    /**
     * Build the body of the request.
     *
     * @return mixed
     */
    abstract protected function buildBody();

    /**
     * Return the request in array.
     *
     * @return array
     */
    public function build(): array
    {
        return [
            'headers' => $this->buildRequestHeader(),
            'json' => $this->buildBody(),
        ];
    }
}
