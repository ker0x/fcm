<?php
namespace Kerox\Fcm;

use GuzzleHttp\Psr7\Response;
use Kerox\Fcm\Request\GroupRequest;

class FcmGroup extends BaseSender
{

    const URL = 'https://android.googleapis.com/gcm/notification';

    const CREATE = 'create';
    const ADD = 'add';
    const DELETE = 'delete';

    /**
     * FcmGroup constructor.
     *
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        parent::__construct($apiKey);
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
        $request = new GroupRequest(self::CREATE, $notificationKeyName, null, $registrationIds);
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
        $request = new GroupRequest(self::ADD, $notificationKeyName, $notificationKey, $registrationIds);
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
        $request = new GroupRequest(self::DELETE, $notificationKeyName, $notificationKey, $registrationIds);
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
