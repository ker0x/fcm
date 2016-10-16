<?php
namespace Kerox\Fcm\Message;

use Kerox\Fcm\Message\Exception\InvalidNotificationException;

/**
 * Class Notification
 * @package Kerox\Fcm\Message
 */
class Notification
{

    use BuilderAwareTrait;

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
     * Notification constructor.
     * @param array|\Kerox\Fcm\Message\NotificationBuilder $notificationBuilder
     */
    public function __construct($notificationBuilder)
    {
        if (is_array($notificationBuilder)) {
            $notificationBuilder = $this->fromArray($notificationBuilder);
        }

        $this->title = $notificationBuilder->getTitle();
        $this->body = $notificationBuilder->getBody();
        $this->sound = $notificationBuilder->getSound();
        $this->badge = $notificationBuilder->getBadge();
        $this->icon = $notificationBuilder->getIcon();
        $this->tag = $notificationBuilder->getTag();
        $this->color = $notificationBuilder->getColor();
        $this->clickAction = $notificationBuilder->getClickAction();
        $this->bodyLocKey = $notificationBuilder->getBodyLocKey();
        $this->bodyLocArgs = $notificationBuilder->getBodyLocArgs();
        $this->titleLocKey = $notificationBuilder->getTitleLocKey();
        $this->titleLocArgs = $notificationBuilder->getTitleLocArgs();
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $notification = [
            'title' => $this->title,
            'body' => $this->body,
            'sound' => $this->sound,
            'badge' => $this->badge,
            'icon' => $this->icon,
            'tag' => $this->tag,
            'color' => $this->color,
            'click_action' => $this->clickAction,
            'body_loc_key' => $this->bodyLocKey,
            'body_loc_args' => $this->bodyLocArgs,
            'title_loc_key' => $this->titleLocKey,
            'title_loc_args' => $this->titleLocArgs,
        ];

        return array_filter($notification);
    }

    /**
     * @param array $notificationArray
     * @return \Kerox\Fcm\Message\NotificationBuilder
     * @throws \Kerox\Fcm\Message\Exception\InvalidNotificationException
     */
    private function fromArray(array $notificationArray): NotificationBuilder
    {
        if (empty($notificationArray) || !isset($notificationArray['title'])) {
            throw InvalidNotificationException::invalidArray();
        }

        $notificationBuilder = new NotificationBuilder($notificationArray['title']);
        unset($notificationArray['title']);
        foreach ($notificationArray as $key => $value) {
            $key = self::camelize($key);
            $setter = 'set' . $key;
            $notificationBuilder->$setter($value);
        }

        return $notificationBuilder;
    }
}
