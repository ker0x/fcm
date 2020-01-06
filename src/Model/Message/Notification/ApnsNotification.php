<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message\Notification;

use InvalidArgumentException;
use Kerox\Fcm\Helper\UtilityTrait;
use Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert;
use Kerox\Fcm\Model\Message\Notification\ApnsNotification\Sound;

/**
 * Class ApnsNotification.
 */
class ApnsNotification implements \JsonSerializable
{
    use UtilityTrait;

    /**
     * @var string|\Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert|null
     */
    private $alert;

    /**
     * @var \Kerox\Fcm\Model\Message\Notification\ApnsNotification\Sound|string
     */
    private $sound = Sound::DEFAULT_NAME;

    /**
     * @var int
     */
    private $badge = 1;

    /**
     * @var int
     */
    private $contentAvailable = 0;

    /**
     * @var string|null
     */
    private $category;

    /**
     * @var string|null
     */
    private $threadId;

    /**
     * @var int
     */
    private $mutableContent = 0;

    /**
     * @var string|null
     */
    private $targetContentId;

    /**
     * @param string|\Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert $alert
     *
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification
     */
    public function setAlert($alert): self
    {
        if (\is_string($alert)) {
            $alert = (new Alert())->setBody($alert);
        }

        if (!$alert instanceof Alert) {
            throw new InvalidArgumentException(sprintf('alert must be a string or an instance of "%s".', Alert::class));
        }

        $this->alert = $alert;

        return $this;
    }

    /**
     * @param \Kerox\Fcm\Model\Message\Notification\ApnsNotification\Sound|string $sound
     *
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification
     */
    public function setSound($sound): self
    {
        $this->sound = $sound;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification
     */
    public function setBadge(bool $badge): self
    {
        $this->badge = (int) $badge;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification
     */
    public function setContentAvailable(bool $contentAvailable): self
    {
        $this->contentAvailable = (int) $contentAvailable;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification
     */
    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification
     */
    public function setThreadId(string $threadId): self
    {
        $this->threadId = $threadId;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification
     */
    public function isMutableContent(bool $mutableContent = true): self
    {
        $this->mutableContent = (int) $mutableContent;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification
     */
    public function setTargetContentId(string $targetContentId): self
    {
        $this->targetContentId = $targetContentId;

        return $this;
    }

    public function toArray(): array
    {
        $json = [
            'alert' => $this->alert,
            'badge' => $this->badge,
            'sound' => $this->sound,
            'thread-id' => $this->threadId,
            'category' => $this->category,
            'content-available' => $this->contentAvailable,
            'mutable-content' => $this->mutableContent,
            'target-content-id' => $this->targetContentId,
        ];

        return $this->arrayFilter(['aps' => $json]);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
