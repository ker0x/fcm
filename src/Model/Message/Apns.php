<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message;

use Kerox\Fcm\Helper\ValidatorTrait;
use Kerox\Fcm\Model\Message\Notification\ApnsNotification;
use Kerox\Fcm\Model\Message\Options\ApnsOptions;

class Apns implements \JsonSerializable
{
    use ValidatorTrait;

    /**
     * @var array
     */
    private $headers = [];

    /**
     * @var \Kerox\Fcm\Model\Message\Notification\ApnsNotification|null
     */
    private $payload;

    /**
     * @var \Kerox\Fcm\Model\Message\Options\ApnsOptions|null
     */
    private $options;

    /**
     * @return \Kerox\Fcm\Model\Message\Apns
     */
    public function setHeaders(array $headers): self
    {
        $this->isValidData($headers);

        $this->headers = $headers;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Apns
     */
    public function setPayload(ApnsNotification $payload): self
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Apns
     */
    public function setOptions(ApnsOptions $options): self
    {
        $this->options = $options;

        return $this;
    }

    public function toArray(): array
    {
        $array = [
            'headers' => $this->headers,
            'payload' => $this->payload,
            'fcm_options' => $this->options,
        ];

        return array_filter($array);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
