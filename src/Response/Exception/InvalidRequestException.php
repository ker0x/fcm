<?php
namespace Kerox\Fcm\Response\Exception;

/**
 * Class InvalidRequestException
 * @package Kerox\Fcm\Response\Exception
 */
class InvalidRequestException extends \Exception
{

    /**
     * InvalidRequestException constructor.
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
