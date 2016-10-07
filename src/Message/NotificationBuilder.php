<?php
namespace ker0x\Fcm\Message;
use ker0x\Fcm\Message\Exception\InvalidNotificationException;

/**
 * Class NotificationBuilder
 * @package Fcm\Message
 */
class NotificationBuilder
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
     * @var null|string
     */
    protected $sound;

    /**
     * @var null|string
     */
    protected $badge;

    /**
     * @var null|string
     */
    protected $icon;

    /**
     * @var null|string
     */
    protected $tag;

    /**
     * @var null|string
     */
    protected $color;

    /**
     * @var null|string
     */
    protected $clickAction;

    /**
     * @var null|string
     */
    protected $bodyLocKey;

    /**
     * @var null|string
     */
    protected $bodyLocArgs;

    /**
     * @var null|string
     */
    protected $titleLocKey;

    /**
     * @var null|string
     */
    protected $titleLocArgs;

    /**
     * NotificationBuilder constructor.
     * @param string $title
     */
    public function __construct(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return \ker0x\Fcm\Message\NotificationBuilder
     */
    public function setBody(string $body): NotificationBuilder
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSound()
    {
        return $this->sound;
    }

    /**
     * @param string $sound
     * @return \ker0x\Fcm\Message\NotificationBuilder
     */
    public function setSound(string $sound): NotificationBuilder
    {
        $this->sound = $sound;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBadge()
    {
        return $this->badge;
    }

    /**
     * @param string $badge
     * @return \ker0x\Fcm\Message\NotificationBuilder
     */
    public function setBadge(string $badge): NotificationBuilder
    {
        $this->badge = $badge;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     * @return \ker0x\Fcm\Message\NotificationBuilder
     */
    public function setIcon(string $icon): NotificationBuilder
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param string $tag
     * @return \ker0x\Fcm\Message\NotificationBuilder
     */
    public function setTag(string $tag): NotificationBuilder
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string $color
     * @return \ker0x\Fcm\Message\NotificationBuilder
     * @throws \ker0x\Fcm\Message\Exception\InvalidNotificationException
     */
    public function setColor(string $color): NotificationBuilder
    {
        if (!preg_match('/^#[A-Fa-f0-9]{6}$/', $color)) {
            throw InvalidNotificationException::invalidColor();
        }
        $this->color = $color;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getClickAction()
    {
        return $this->clickAction;
    }

    /**
     * @param string $clickAction
     * @return \ker0x\Fcm\Message\NotificationBuilder
     */
    public function setClickAction(string $clickAction): NotificationBuilder
    {
        $this->clickAction = $clickAction;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBodyLocKey()
    {
        return $this->bodyLocKey;
    }

    /**
     * @param string $bodyLocKey
     * @return \ker0x\Fcm\Message\NotificationBuilder
     */
    public function setBodyLocKey(string $bodyLocKey): NotificationBuilder
    {
        $this->bodyLocKey = $bodyLocKey;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBodyLocArgs()
    {
        return $this->bodyLocArgs;
    }

    /**
     * @param string $bodyLocArgs
     * @return \ker0x\Fcm\Message\NotificationBuilder
     */
    public function setBodyLocArgs(string $bodyLocArgs): NotificationBuilder
    {
        $this->bodyLocArgs = $bodyLocArgs;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitleLocKey()
    {
        return $this->titleLocKey;
    }

    /**
     * @param string $titleLocKey
     * @return \ker0x\Fcm\Message\NotificationBuilder
     */
    public function setTitleLocKey(string $titleLocKey): NotificationBuilder
    {
        $this->titleLocKey = $titleLocKey;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitleLocArgs()
    {
        return $this->titleLocArgs;
    }

    /**
     * @param string $titleLocArgs
     * @return \ker0x\Fcm\Message\NotificationBuilder
     */
    public function setTitleLocArgs(string $titleLocArgs): NotificationBuilder
    {
        $this->titleLocArgs = $titleLocArgs;

        return $this;
    }
}
