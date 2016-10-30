<?php
namespace Kerox\Fcm;

use GuzzleHttp\Psr7\Response;
use Kerox\Fcm\Request\GroupRequest;

/**
 * Class FcmGroup
 * @package Kerox\Fcm
 */
class FcmGroup extends BaseSender
{

    const URL = 'https://android.googleapis.com/gcm/notification';

    const CREATE = 'create';
    const ADD = 'add';
    const DELETE = 'delete';

    /**
     * @var string
     */
    protected $senderId;

    /**
     * FcmGroup constructor.
     *
     * @param string $apiKey
     * @param string $senderId
     */
    public function __construct(string $apiKey, string $senderId)
    {
        parent::__construct($apiKey);

        $this->senderId = $senderId;
    }

    /**
     * Create a device group.
     *
     * @param string $notificationKeyName
     * @param string|array $registrationIds
     * @return null|string
     */
    public function createGroup(string $notificationKeyName, $registrationIds)
    {
        $request = new GroupRequest($this->apiKey, $this->senderId, self::CREATE, $notificationKeyName, null, $registrationIds);
        $response = $this->doRequest(self::URL, $request->build());

        return $this->getNotificationKey($response);
    }

    /**
     * Add a device to a group.
     *
     * @param string $notificationKeyName
     * @param string $notificationKey
     * @param string|array $registrationIds
     * @return null|string
     */
    public function addToGroup(string $notificationKeyName, string $notificationKey, $registrationIds)
    {
        $request = new GroupRequest($this->apiKey, $this->senderId, self::ADD, $notificationKeyName, $notificationKey, $registrationIds);
        $response = $this->doRequest(self::URL, $request->build());

        return $this->getNotificationKey($response);
    }

    /**
     * Remove a device from a group.
     *
     * @param string $notificationKeyName
     * @param string $notificationKey
     * @param string|array $registrationIds
     * @return null|string
     */
    public function removeFromGroup(string $notificationKeyName, string $notificationKey, $registrationIds)
    {
        $request = new GroupRequest($this->apiKey, $this->senderId, self::DELETE, $notificationKeyName, $notificationKey, $registrationIds);
        $response = $this->doRequest(self::URL, $request->build());

        return $this->getNotificationKey($response);
    }

    /**
     * Return the notification key from the response.
     *
     * @param \GuzzleHttp\Psr7\Response $response
     * @return null|string
     */
    private function getNotificationKey(Response $response)
    {
        if ($response->getStatusCode() != 200) {
            return null;
        }
        $body = json_decode($response->getBody(), true);

        return $body['notification_key'];
    }
}
