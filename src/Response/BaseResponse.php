<?php
namespace Kerox\Fcm\Response;

use GuzzleHttp\Psr7\Response;
use Kerox\Fcm\Response\Exception\InvalidRequestException;
use Kerox\Fcm\Response\Exception\ServerResponseException;
use Kerox\Fcm\Response\Exception\UnauthorizedRequestException;

abstract class BaseResponse
{

    const SUCCESS = 'success';
    const FAILURE = 'failure';
    const ERROR = 'error';
    const MESSAGE_ID = 'message_id';

    /**
     * @var int
     */
    protected $numberSuccess = 0;

    /**
     * @var int
     */
    protected $numberFailure = 0;

    /**
     * BaseResponse constructor.
     *
     * @param \GuzzleHttp\Psr7\Response $response
     */
    public function __construct(Response $response)
    {
        $this->isRequestSuccess($response);
        $this->parseResponse(json_decode($response->getBody(), true));
    }

    /**
     * Check the status code of the request.
     *
     * @param \GuzzleHttp\Psr7\Response $response The response of the push.
     * @throws \Kerox\Fcm\Response\Exception\InvalidRequestException
     * @throws \Kerox\Fcm\Response\Exception\ServerResponseException
     * @throws \Kerox\Fcm\Response\Exception\UnauthorizedRequestException
     */
    private function isRequestSuccess(Response $response)
    {
        if ($response->getStatusCode() == 200) {
            return;
        }

        if ($response->getStatusCode() == 400) {
            throw new InvalidRequestException($response);
        }

        if ($response->getStatusCode() == 401) {
            throw new UnauthorizedRequestException($response);
        }

        throw new ServerResponseException($response);
    }

    /**
     * Setter for numberSuccess.
     *
     * @param array $response
     */
    protected function setNumberSuccess(array $response)
    {
        if (isset($response[self::SUCCESS])) {
            $this->numberSuccess = $response[self::SUCCESS];
        }
    }

    /**
     * Setter for numberFailure.
     *
     * @param array $response
     */
    protected function setNumberFailure(array $response)
    {
        if (isset($response[self::FAILURE])) {
            $this->numberFailure = $response[self::FAILURE];
        }
    }

    /**
     * Parse the response.
     *
     * @param array $response
     * @return mixed
     */
    abstract protected function parseResponse(array $response);
}
