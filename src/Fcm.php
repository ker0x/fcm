<?php
namespace Kerox\Fcm;

use Kerox\Fcm\Message\Data;
use Kerox\Fcm\Message\Notification;
use Kerox\Fcm\Message\Options;
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
     * @var null|array|\Kerox\Fcm\Message\NotificationBuilder
     */
    protected $notification;

    /**
     * @var null|array|\Kerox\Fcm\Message\DataBuilder
     */
    protected $data;

    /**
     * @var null|array|\Kerox\Fcm\Message\OptionsBuilder
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
     * @param  array|\Kerox\Fcm\Message\NotificationBuilder $notification Notification for the push.
     * @return $this
     */
    public function setNotification($notification)
    {
        $this->notification = new Notification($notification);

        return $this;
    }

    /**
     * Setter for data.
     *
     * @param  array|\Kerox\Fcm\Message\DataBuilder $data Data for the push.
     * @return $this
     */
    public function setData($data)
    {
        $this->data = new Data($data);

        return $this;
    }

    /**
     * Setter for options.
     *
     * @param  array|\Kerox\Fcm\Message\OptionsBuilder $options Options for the push.
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = new Options($options);

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
     * @param  $topic
     * @return \Kerox\Fcm\Response\TopicResponse
     */
    public function sendToTopic($topic): TopicResponse
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
