<?php

declare(strict_types=1);

namespace Kerox\Fcm;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Kerox\Fcm\Api\Send;

/**
 * Class Fcm.
 */
class Fcm
{
    public const API_URL = 'https://fcm.googleapis.com/';
    public const API_VERSION = 'v1';

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
     * Fcm constructor.
     *
     * @param string                           $oauthToken
     * @param string                           $projectId
     * @param \GuzzleHttp\ClientInterface|null $client
     */
    public function __construct(string $oauthToken, string $projectId, ?ClientInterface $client = null)
    {
        $this->oauthToken = $oauthToken;
        $this->projectId = $projectId;

        if ($client === null) {
            $client = new Client([
                'base_uri' => self::API_URL . self::API_VERSION . '/projects/',
            ]);
        }
        $this->client = $client;
    }

    public function send(): Send
    {
        return new Send($this->oauthToken, $this->projectId, $this->client);
    }
}
