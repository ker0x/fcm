<?php
namespace Kerox\Fcm\Response\Exception;

class ServerResponseException extends \Exception
{

    /**
     * ServerResponseException constructor.
     *
     * @param \GuzzleHttp\Psr7\Response $response
     */
    public function __construct($response)
    {
        $code = $response->getStatusCode();
        $body = $response->getBody()->getContents();

        parent::__construct($body, $code);
    }
}