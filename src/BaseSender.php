<?php
namespace Kerox\Fcm;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

abstract class BaseSender
{

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * BaseSender constructor.
     *
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @param string $url
     * @param array $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function doRequest(string $url, array $request): ResponseInterface
    {
        $client = new Client();
        $response = $client->post($url, $request);

        return $response;
    }
}
