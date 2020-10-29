<?php

declare(strict_types=1);

namespace Kerox\Fcm\Api;

use GuzzleHttp\ClientInterface;

abstract class AbstractApi
{
    /**
     * @var string
     */
    protected $oauthToken;

    /**
     * @var string
     */
    protected $projectId;

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * AbstractApi constructor.
     */
    public function __construct(string $oauthToken, string $projectId, ClientInterface $client)
    {
        $this->oauthToken = $oauthToken;
        $this->projectId = $projectId;
        $this->client = $client;
    }
}
