<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message\Notification;

use InvalidArgumentException;
use JsonSerializable;
use Kerox\Fcm\Helper\UtilityTrait;
use Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert;

/**
 * Class ApnsNotification.
 */
class ApnsNotification implements JsonSerializable
{
    use UtilityTrait;

    /**
     * @var null|string|\Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert
     */
    protected $alert;

    /**
     * @var null|string
     */
    protected $sound;

    /**
     * @var null|string
     */
    protected $badge = 1;

    /**
     * @var null|string
     */
    protected $contentAvailable = 0;

    /**
     * @var null|string
     */
    protected $category;

    /**
     * @var null|string
     */
    protected $threadId;

    /**
     * @param string|\Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert $alert
     *
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification
     */
    public function setAlert($alert): self
    {
        if (!\is_string($alert) && !$alert instanceof Alert) {
            throw new InvalidArgumentException(
                sprintf('alert must be a string or an instance of %s.', Alert::class)
            );
        }

        $this->alert = $alert;

        return $this;
    }

    /**
     * @param mixed $sound
     *
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification
     */
    public function setSound(string $sound): self
    {
        $this->sound = $sound;

        return $this;
    }

    /**
     * @param bool $badge
     *
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification
     */
    public function setBadge(bool $badge): self
    {
        $this->badge = (int) $badge;

        return $this;
    }

    /**
     * @param bool $contentAvailable
     *
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification
     */
    public function setContentAvailable(bool $contentAvailable): self
    {
        $this->contentAvailable = (int) $contentAvailable;

        return $this;
    }

    /**
     * @param string $category
     *
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification
     */
    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @param string $threadId
     *
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification
     */
    public function setThreadId(string $threadId): self
    {
        $this->threadId = $threadId;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $json = [
            'alert' => $this->alert,
            'sound' => $this->sound,
            'badge' => $this->badge,
            'content-available' => $this->contentAvailable,
            'category' => $this->category,
            'thread-id' => $this->threadId,
        ];

        return $this->arrayFilter(['aps' => $json]);
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
