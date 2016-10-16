<?php
namespace Kerox\Fcm\Request;

abstract class BaseRequest
{

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
            'Authorization' => 'key=' . $this->apiKey,
            'Content-Type' => 'application/json',
        ];
    }

    /**
     * Build the body of the request
     *
     * @return mixed
     */
    abstract protected function buildBody();

    /**
     * Return the request in array form
     *
     * @return array
     */
    public function build(): array
    {
        return [
            'headers' => $this->buildRequestHeader(),
            'json' => $this->buildBody()
        ];
    }
}