<?php

declare(strict_types=1);

namespace Kerox\Fcm\Response;

use Psr\Http\Message\ResponseInterface;

/**
 * Class AbstractResponse.
 */
abstract class AbstractResponse
{
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    protected $response;

    /**
     * BaseResponse constructor.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;

        $this->parseResponse(json_decode($response->getBody(), true));
    }

    /**
     * Parse the response.
     *
     * @param array $response
     *
     * @return mixed
     */
    abstract protected function parseResponse(array $response);

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
