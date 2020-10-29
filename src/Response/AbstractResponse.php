<?php

declare(strict_types=1);

namespace Kerox\Fcm\Response;

use Psr\Http\Message\ResponseInterface;

abstract class AbstractResponse
{
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    protected $response;

    /**
     * BaseResponse constructor.
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;

        $this->parseResponse(json_decode($response->getBody()->__toString(), true));
    }

    /**
     * Parse the response.
     *
     * @return mixed
     */
    abstract protected function parseResponse(array $response);

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
