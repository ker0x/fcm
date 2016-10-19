<?php
namespace Kerox\Fcm\Message;

use Kerox\Fcm\Message\Exception\InvalidNotificationException;

/**
 * Class NotificationBuilder
 * @package Fcm\Message
 */
class NotificationBuilder implements BuilderInterface
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
     *
     * @param string $title
     */
    public function __construct(string $title)
    {
        $this->title = $title;
    }

    /**
     * Getter for title.
     *
     * @return null|string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Getter for body.
     *
     * @return null|string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Setter for body.
     *
     * @param string $body
     * @return \Kerox\Fcm\Message\NotificationBuilder
     */
    public function setBody(string $body): NotificationBuilder
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Getter for sound.
     *
     * @return null|string
     */
    public function getSound()
    {
        return $this->sound;
    }

    /**
     * Setter for sound.
     *
     * @param string $sound
     * @return \Kerox\Fcm\Message\NotificationBuilder
     */
    public function setSound(string $sound): NotificationBuilder
    {
        $this->sound = $sound;

        return $this;
    }

    /**
     * Getter for badge.
     *
     * @return null|string
     */
    public function getBadge()
    {
        return $this->badge;
    }

    /**
     * Setter for badge.
     *
     * @param string $badge
     * @return \Kerox\Fcm\Message\NotificationBuilder
     */
    public function setBadge(string $badge): NotificationBuilder
    {
        $this->badge = $badge;

        return $this;
    }

    /**
     * Getter for icon.
     *
     * @return null|string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Setter for icon.
     *
     * @param string $icon
     * @return \Kerox\Fcm\Message\NotificationBuilder
     */
    public function setIcon(string $icon): NotificationBuilder
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Getter for tag.
     *
     * @return null|string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Setter for tag.
     *
     * @param string $tag
     * @return \Kerox\Fcm\Message\NotificationBuilder
     */
    public function setTag(string $tag): NotificationBuilder
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Getter for color.
     *
     * @return null|string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Setter for color.
     *
     * @param string $color
     * @return \Kerox\Fcm\Message\NotificationBuilder
     * @throws \Kerox\Fcm\Message\Exception\InvalidNotificationException
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
     * Getter for clickAction.
     *
     * @return null|string
     */
    public function getClickAction()
    {
        return $this->clickAction;
    }

    /**
     * Setter for clickAction.
     *
     * @param string $clickAction
     * @return \Kerox\Fcm\Message\NotificationBuilder
     */
    public function setClickAction(string $clickAction): NotificationBuilder
    {
        $this->clickAction = $clickAction;

        return $this;
    }

    /**
     * Getter for bodyLocKey.
     *
     * @return null|string
     */
    public function getBodyLocKey()
    {
        return $this->bodyLocKey;
    }

    /**
     * Setter for bodyLocKey.
     *
     * @param string $bodyLocKey
     * @return \Kerox\Fcm\Message\NotificationBuilder
     */
    public function setBodyLocKey(string $bodyLocKey): NotificationBuilder
    {
        $this->bodyLocKey = $bodyLocKey;

        return $this;
    }

    /**
     * Getter for bodyLocArgs.
     *
     * @return null|string
     */
    public function getBodyLocArgs()
    {
        return $this->bodyLocArgs;
    }

    /**
     * Setter for bodyLocArgs.
     *
     * @param string $bodyLocArgs
     * @return \Kerox\Fcm\Message\NotificationBuilder
     */
    public function setBodyLocArgs(string $bodyLocArgs): NotificationBuilder
    {
        $this->bodyLocArgs = $bodyLocArgs;

        return $this;
    }

    /**
     * Getter for titleLocKey.
     *
     * @return null|string
     */
    public function getTitleLocKey()
    {
        return $this->titleLocKey;
    }

    /**
     * Setter for titleLocKey.
     *
     * @param string $titleLocKey
     * @return \Kerox\Fcm\Message\NotificationBuilder
     */
    public function setTitleLocKey(string $titleLocKey): NotificationBuilder
    {
        $this->titleLocKey = $titleLocKey;

        return $this;
    }

    /**
     * Getter for titleLocArgs.
     *
     * @return null|string
     */
    public function getTitleLocArgs()
    {
        return $this->titleLocArgs;
    }

    /**
     * Setter for titleLocArgs.
     *
     * @param string $titleLocArgs
     * @return \Kerox\Fcm\Message\NotificationBuilder
     */
    public function setTitleLocArgs(string $titleLocArgs): NotificationBuilder
    {
        $this->titleLocArgs = $titleLocArgs;

        return $this;
    }

    /**
     * Build the notification.
     *
     * @return \Kerox\Fcm\Message\Notification
     */
    public function build(): Notification
    {
        return new Notification($this);
    }
}
