<?php
namespace Kerox\Fcm;

use Kerox\Fcm\Message\Data;
use Kerox\Fcm\Message\Notification;
use Kerox\Fcm\Message\Options;
use Kerox\Fcm\Message\Topics;
use Kerox\Fcm\Request\Request;
use Kerox\Fcm\Response\DownstreamResponse;
use Kerox\Fcm\Response\GroupResponse;
use Kerox\Fcm\Response\TopicResponse;

class Fcm extends BaseSender
{

    const URL = 'https://fcm.googleapis.com/fcm/send';

    const MAX_TOKEN_PER_REQUEST = 1000;

    /**
     * @var string|array
     */
    protected $targets;

    /**
     * @var null|\Kerox\Fcm\Message\Notification
     */
    protected $notification;

    /**
     * @var null|\Kerox\Fcm\Message\Data
     */
    protected $data;

    /**
     * @var null|\Kerox\Fcm\Message\Options
     */
    protected $options;

    /**
     * Fcm constructor.
     *
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        parent::__construct($apiKey);
    }

    /**
     * Setter for notification.
     *
     * @param  array|\Kerox\Fcm\Message\Notification $notification Notification for the push.
     * @return $this
     */
    public function setNotification($notification)
    {
        if (is_array($notification)) {
            $notification = new Notification($notification);
        }
        $this->notification = $notification;

        return $this;
    }

    /**
     * Setter for data.
     *
     * @param  array|\Kerox\Fcm\Message\Data $data Data for the push.
     * @return $this
     */
    public function setData($data)
    {
        if (is_array($data)) {
            $data = new Data($data);
        }
        $this->data = $data;

        return $this;
    }

    /**
     * Setter for options.
     *
     * @param  array|\Kerox\Fcm\Message\Options $options Options for the push.
     * @return $this
     */
    public function setOptions($options)
    {
        if (is_array($options)) {
            $options = new Options($options);
        }
        $this->options = $options;

        return $this;
    }

    /**
     * Send a push notification to targets.
     *
     * @param  string|array $targets Targets to send the push notification.
     * @return \Kerox\Fcm\Response\DownstreamResponse|null
     */
    public function sendTo($targets)
    {
        $response = null;

        if (is_array($targets) && (empty($targets))) {
            $partialTargets = array_chunk($targets, self::MAX_TOKEN_PER_REQUEST, false);
            foreach ($partialTargets as $targets) {
                $request = new Request($this->apiKey, $targets, $this->notification, $this->data, $this->options);
                $baseResponse = $this->doRequest(self::URL, $request->build());

                $partialResponse = new DownstreamResponse($baseResponse, $targets);
                if (!$response) {
                    $response = $partialResponse;
                } else {
                    $response->merge($partialResponse);
                }
            }
        } else {
            $request = new Request($this->apiKey, $targets, $this->notification, $this->data, $this->options);
            $baseResponse = $this->doRequest(self::URL, $request->build());

            $response = new DownstreamResponse($baseResponse, $targets);
        }

        return $response;
    }

    /**
     * Send a push notification to a topic.
     *
     * @param  \Kerox\Fcm\Message\Topics $topic
     * @return \Kerox\Fcm\Response\TopicResponse
     */
    public function sendToTopic(Topics $topic): TopicResponse
    {
        $request = new Request($this->apiKey, null, $this->notification, $this->data, $this->options, $topic);
        $response = $this->doRequest(self::URL, $request->build());

        return new TopicResponse($response, $topic);
    }

    /**
     * Send a push notification to a group.
     *
     * @param  string $notificationKey
     * @return \Kerox\Fcm\Response\GroupResponse
     */
    public function sendToGroup(string $notificationKey): GroupResponse
    {
        $request = new Request($this->apiKey, $notificationKey, $this->notification, $this->data, $this->options);
        $response = $this->doRequest(self::URL, $request->build());

        return new GroupResponse($response, $notificationKey);
    }
}
