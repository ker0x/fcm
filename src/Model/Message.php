<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model;

use Kerox\Fcm\Helper\ValidatorTrait;
use Kerox\Fcm\Model\Message\Android;
use Kerox\Fcm\Model\Message\Apns;
use Kerox\Fcm\Model\Message\Webpush;

/**
 * Class Message.
 */
class Message implements \JsonSerializable
{
    use ValidatorTrait;

    public const TARGET_TYPE_TOKEN = 'token';
    public const TARGET_TYPE_TOPIC = 'topic';
    public const TARGET_TYPE_CONDITION = 'condition';

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var \Kerox\Fcm\Model\Notification|string
     */
    protected $notification;

    /**
     * @var \Kerox\Fcm\Model\Message\Android
     */
    protected $android;

    /**
     * @var \Kerox\Fcm\Model\Message\Webpush
     */
    protected $webpush;

    /**
     * @var \Kerox\Fcm\Model\Message\Apns
     */
    protected $apns;

    /**
     * @var null|string
     */
    protected $token;

    /**
     * @var null|string
     */
    protected $topic;

    /**
     * @var \Kerox\Fcm\Model\Message\Condition
     */
    protected $condition;

    /**
     * Message constructor.
     *
     * @param \Kerox\Fcm\Model\Notification|string $message
     *
     * @throws \Exception
     */
    public function __construct($message)
    {
        if (\is_string($message)) {
            $notification = new Notification($message);
        } elseif ($message instanceof Notification) {
            $notification = $message;
        } else {
            throw new \InvalidArgumentException(
                sprintf('$message must be a string or an instance of %s.', Notification::class)
            );
        }

        $this->notification = $notification;
    }

    /**
     * @param array $data
     *
     * @return \Kerox\Fcm\Model\Message
     */
    public function setData(array $data): self
    {
        $this->isValidData($data);

        $this->data = $data;

        return $this;
    }

    /**
     * @param \Kerox\Fcm\Model\Message\Android $android
     *
     * @return \Kerox\Fcm\Model\Message
     */
    public function setAndroid(Android $android): self
    {
        $this->android = $android;

        return $this;
    }

    /**
     * @param \Kerox\Fcm\Model\Message\Webpush $webpush
     *
     * @return \Kerox\Fcm\Model\Message
     */
    public function setWebpush(Webpush $webpush): self
    {
        $this->webpush = $webpush;

        return $this;
    }

    /**
     * @param \Kerox\Fcm\Model\Message\Apns $apns
     *
     * @return \Kerox\Fcm\Model\Message
     */
    public function setApns(Apns $apns): self
    {
        $this->apns = $apns;

        return $this;
    }

    /**
     * @param string|\Kerox\Fcm\Model\Message\Condition $target
     * @param string                                    $type
     *
     * @return \Kerox\Fcm\Model\Message
     */
    public function setTarget($target, string $type = self::TARGET_TYPE_TOKEN): self
    {
        $this->token = $this->topic = $this->condition = null;

        if ($type === self::TARGET_TYPE_TOKEN) {
            $this->token = $target;
        } elseif ($type === self::TARGET_TYPE_TOPIC) {
            $this->topic = $target;
        } elseif ($type === self::TARGET_TYPE_CONDITION) {
            $this->condition = $target;
        }

        return $this;
    }

    /**
     * @param string $token
     *
     * @return \Kerox\Fcm\Model\Message
     */
    public function setToken(string $token): self
    {
        $this->topic = $this->condition = null;
        $this->token = $token;

        return $this;
    }

    /**
     * @param string $topic
     *
     * @return \Kerox\Fcm\Model\Message
     */
    public function setTopic(string $topic): self
    {
        $this->isValidTopicName($topic);

        $this->token = $this->condition = null;
        $this->topic = $topic;

        return $this;
    }

    /**
     * @param string $condition
     *
     * @return \Kerox\Fcm\Model\Message
     */
    public function setCondition(string $condition): self
    {
        $this->token = $this->topic = null;
        $this->condition = $condition;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [
            'data' => $this->data,
            'notification' => $this->notification,
            'android' => $this->android,
            'webpush' => $this->webpush,
            'apns' => $this->apns,
            'token' => $this->token,
            'topic' => $this->topic,
            'condition' => $this->condition,
        ];

        return array_filter($array);
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
