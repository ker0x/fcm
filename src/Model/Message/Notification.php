<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message;

class Notification extends AbstractNotification
{
    /**
     * Notification constructor.
     */
    public function __construct(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification
     */
    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }
}
