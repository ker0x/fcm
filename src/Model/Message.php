<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model;

use Kerox\Fcm\Helper\UtilityTrait;
use Kerox\Fcm\Helper\ValidatorTrait;
use Kerox\Fcm\Model\Message\Android;
use Kerox\Fcm\Model\Message\Apns;
use Kerox\Fcm\Model\Message\Notification;
use Kerox\Fcm\Model\Message\Options;
use Kerox\Fcm\Model\Message\Webpush;

class Message implements \JsonSerializable
{
    use UtilityTrait;
    use ValidatorTrait;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var array
     */
    private $data = [];

    /**
     * @var \Kerox\Fcm\Model\Message\Notification
     */
    private $notification;

    /**
     * @var \Kerox\Fcm\Model\Message\Android
     */
    private $android;

    /**
     * @var \Kerox\Fcm\Model\Message\Webpush
     */
    private $webpush;

    /**
     * @var \Kerox\Fcm\Model\Message\Apns
     */
    private $apns;

    /**
     * @var string|null
     */
    private $token;

    /**
     * @var \Kerox\Fcm\Model\Message\Options|null
     */
    private $options;

    /**
     * @var string|null
     */
    protected $topic;

    /**
     * @var string|null
     */
    protected $condition;

    /**
     * Message constructor.
     *
     * @param \Kerox\Fcm\Model\Message\Notification|string $message
     *
     * @throws \Exception
     */
    public function __construct($message)
    {
        if (\is_string($message)) {
            $message = new Notification($message);
        }

        if (!$message instanceof Notification) {
            throw new \InvalidArgumentException(sprintf('$message must be a string or an instance of "%s".', Notification::class));
        }

        $this->notification = $message;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message
     */
    public function setData(array $data): self
    {
        $this->isValidData($data);

        $this->data = $data;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message
     */
    public function setAndroid(Android $android): self
    {
        $this->android = $android;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message
     */
    public function setWebpush(Webpush $webpush): self
    {
        $this->webpush = $webpush;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message
     */
    public function setApns(Apns $apns): self
    {
        $this->apns = $apns;

        return $this;
    }

    public function setOptions(Options $options): self
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message
     */
    public function setToken(string $token): self
    {
        $this->topic = $this->condition = null;
        $this->token = $token;

        return $this;
    }

    /**
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
     * @return \Kerox\Fcm\Model\Message
     */
    public function setCondition(string $condition): self
    {
        $this->token = $this->topic = null;
        $this->condition = $condition;

        return $this;
    }

    public function toArray(): array
    {
        $array = [
            'name' => $this->name,
            'data' => $this->data,
            'notification' => $this->notification,
            'android' => $this->android,
            'webpush' => $this->webpush,
            'apns' => $this->apns,
            'fcm_options' => $this->options,
            'token' => $this->token,
            'topic' => $this->topic,
            'condition' => $this->condition,
        ];

        return array_filter($array);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
