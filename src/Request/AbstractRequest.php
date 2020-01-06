<?php

declare(strict_types=1);

namespace Kerox\Fcm\Request;

/**
 * Class BaseRequest.
 */
abstract class AbstractRequest
{
    /**
     * @var string
     */
    protected $oauthToken;

    /**
     * BaseRequest constructor.
     */
    public function __construct(string $oauthToken)
    {
        $this->oauthToken = $oauthToken;
    }

    /**
     * Build the header for the request.
     */
    protected function buildHeaders(): array
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->oauthToken,
            'Content-Type' => 'application/json',
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
     */
    public function build(): array
    {
        return [
            'headers' => $this->buildHeaders(),
            'json' => $this->buildBody(),
        ];
    }
}
