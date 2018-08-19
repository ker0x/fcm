<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message;

/**
 * Class Notification.
 */
class Notification extends AbstractNotification
{
    /**
     * Notification constructor.
     *
     * @param string $title
     */
    public function __construct(string $title)
    {
        $this->title = $title;
    }

    /**
     * @param string $body
     *
     * @return \Kerox\Fcm\Model\Message\Notification
     */
    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }
}
