<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message;

use Kerox\Fcm\Helper\ValidatorTrait;
use Kerox\Fcm\Model\Message\Notification\WebpushNotification;

class Webpush implements \JsonSerializable
{
    use ValidatorTrait;

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var \Kerox\Fcm\Model\Message\Notification\WebpushNotification
     */
    protected $notification;

    /**
     * @var array
     */
    protected $fcmOptions = [];

    /**
     * @param array $headers
     *
     * @return Webpush
     */
    public function setHeaders(array $headers): self
    {
        $this->isValidData($headers);

        $this->headers = $headers;

        return $this;
    }

    /**
     * @param array $data
     *
     * @return Webpush
     */
    public function setData(array $data): self
    {
        $this->isValidData($data);

        $this->data = $data;

        return $this;
    }

    /**
     * @param \Kerox\Fcm\Model\Message\Notification\WebpushNotification $notification
     *
     * @return Webpush
     */
    public function setNotification(WebpushNotification $notification): self
    {
        $this->notification = $notification;

        return $this;
    }

    /**
     * @param array $fcmOptions
     *
     * @return Webpush
     */
    public function setFcmOptions(array $fcmOptions): self
    {
        $this->fcmOptions = $fcmOptions;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [
            'headers' => $this->headers,
            'data' => $this->data,
            'notification' => $this->notification,
            'fcm_options' => $this->fcmOptions,
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
