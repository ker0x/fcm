<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message;

abstract class AbstractNotification implements NotificationInterface, \JsonSerializable
{
    /**
     * @var string|null
     */
    protected $title;

    /**
     * @var string|null
     */
    protected $body;

    abstract public function setBody(string $body);

    public function toArray(): array
    {
        $array = [
            'title' => $this->title,
            'body' => $this->body,
        ];

        return array_filter($array);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
