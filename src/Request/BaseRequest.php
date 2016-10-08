<?php
namespace Kerox\Fcm\Request;

abstract class BaseRequest
{

    const API_KEY = 'AIzaSyBmXaqLuv8EIyWsVRfzft_jQOdN8-j2nzQ';

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * BaseRequest constructor.
     *
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Build the header for the request
     *
     * @return array
     */
    protected function buildRequestHeader(): array
    {
        return [
            'Authorization' => "key=" . $this->apiKey,
            'Content-Type' => "application/json",
        ];
    }

    /**
     * Build the body of the request
     *
     * @return mixed
     */
    protected abstract function buildBody();

    /**
     * Return the request in array form
     *
     * @return array
     */
    public function build()
    {
        return [
            'headers' => $this->buildRequestHeader(),
            'json' => $this->buildBody()
        ];
    }
}