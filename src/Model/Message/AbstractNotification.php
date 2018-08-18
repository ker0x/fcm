<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message;

use JsonSerializable;

/**
 * Class AbstractNotification.
 */
abstract class AbstractNotification implements NotificationInterface, JsonSerializable
{
    /**
     * @var null|string
     */
    protected $title;

    /**
     * @var null|string
     */
    protected $body;

    /**
     * @param string $body
     */
    abstract public function setBody(string $body);

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [
            'title' => $this->title,
            'body' => $this->body,
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
