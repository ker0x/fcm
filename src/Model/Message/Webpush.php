<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message;

use Kerox\Fcm\Helper\ValidatorTrait;
use Kerox\Fcm\Model\Message\Notification\WebpushNotification;
use Kerox\Fcm\Model\Message\Options\WebpushOptions;

class Webpush implements \JsonSerializable
{
    use ValidatorTrait;

    /**
     * @var array
     */
    private $headers = [];

    /**
     * @var array
     */
    private $data = [];

    /**
     * @var \Kerox\Fcm\Model\Message\Notification\WebpushNotification
     */
    private $notification;

    /**
     * @var \Kerox\Fcm\Model\Message\Options\WebpushOptions|null
     */
    private $options;

    /**
     * @return \Kerox\Fcm\Model\Message\Webpush
     */
    public function setHeaders(array $headers): self
    {
        $this->isValidData($headers);

        $this->headers = $headers;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Webpush
     */
    public function setData(array $data): self
    {
        $this->isValidData($data);

        $this->data = $data;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Webpush
     */
    public function setNotification(WebpushNotification $notification): self
    {
        $this->notification = $notification;

        return $this;
    }

    /**
     * @param \Kerox\Fcm\Model\Message\Options\WebpushOptions|array $options
     *
     * @return \Kerox\Fcm\Model\Message\Webpush
     */
    public function setOptions($options): self
    {
        if (\is_array($options)) {
            trigger_error(sprintf(
                'Using array to set options is deprecated since version 2.1 and will be remove in version 3.0, use class %s instead.',
                WebpushOptions::class
            ), \E_USER_WARNING);

            $options = WebpushOptions::fromArray($options);
        }

        $this->options = $options;

        return $this;
    }

    public function toArray(): array
    {
        $array = [
            'headers' => $this->headers,
            'data' => $this->data,
            'notification' => $this->notification,
            'fcm_options' => $this->options,
        ];

        return array_filter($array);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
