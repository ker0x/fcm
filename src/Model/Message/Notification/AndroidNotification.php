<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message\Notification;

use Kerox\Fcm\Model\Message\AbstractNotification;
use Kerox\Fcm\Model\Message\Notification\AndroidNotification\LightSettings;

class AndroidNotification extends AbstractNotification
{
    public const PRIORITY_UNSPECIFIED = 'PRIORITY_UNSPECIFIED';
    public const PRIORITY_MIN = 'PRIORITY_MIN';
    public const PRIORITY_LOW = 'PRIORITY_LOW';
    public const PRIORITY_DEFAULT = 'PRIORITY_DEFAULT';
    public const PRIORITY_HIGH = 'PRIORITY_HIGH';
    public const PRIORITY_MAX = 'PRIORITY_MAX';

    public const VISIBILITY_UNSPECIFIED = 'VISIBILITY_UNSPECIFIED';
    public const VISIBILITY_PRIVATE = 'PRIVATE';
    public const VISIBILITY_PUBLIC = 'PUBLIC';
    public const VISIBILITY_SECRET = 'SECRET';

    /**
     * @var string|null
     */
    private $icon;

    /**
     * @var string|null
     */
    private $color;

    /**
     * @var string|null
     */
    private $sound;

    /**
     * @var string|null
     */
    private $tag;

    /**
     * @var string|null
     */
    private $clickAction;

    /**
     * @var string|null
     */
    private $bodyLocKey;

    /**
     * @var string|null
     */
    private $bodyLocArgs;

    /**
     * @var string|null
     */
    private $titleLocKey;

    /**
     * @var string|null
     */
    private $titleLocArgs;

    /**
     * @var string|null
     */
    private $channelId;

    /**
     * @var string|null
     */
    private $ticker;

    /**
     * @var bool
     */
    private $sticky = false;

    /**
     * @var string|null
     */
    private $eventTime;

    /**
     * @var bool
     */
    private $localOnly = false;

    /**
     * @var string|null
     */
    private $notificationPriority;

    /**
     * @var bool
     */
    private $defaultSound = false;

    /**
     * @var bool
     */
    private $defaultVibrateTimings = false;

    /**
     * @var bool
     */
    private $defaultLightSettings = false;

    /**
     * @var array
     */
    private $vibrateTimings = [];

    /**
     * @var string|null
     */
    private $visibility;

    /**
     * @var int
     */
    private $notificationCount = 0;

    /**
     * @var \Kerox\Fcm\Model\Message\Notification\AndroidNotification\LightSettings|null
     */
    private $lightSettings;

    /**
     * @var string|null
     */
    private $image;

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setSound(string $sound): self
    {
        $this->sound = $sound;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setTag(string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setClickAction(string $clickAction): self
    {
        $this->clickAction = $clickAction;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setBodyLocKey(string $bodyLocKey): self
    {
        $this->bodyLocKey = $bodyLocKey;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setBodyLocArgs(string $bodyLocArgs): self
    {
        $this->bodyLocArgs = $bodyLocArgs;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setTitleLocKey(string $titleLocKey): self
    {
        $this->titleLocKey = $titleLocKey;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setTitleLocArgs(string $titleLocArgs): self
    {
        $this->titleLocArgs = $titleLocArgs;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setChannelId(string $channelId): self
    {
        $this->channelId = $channelId;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setTicker(string $ticker): self
    {
        $this->ticker = $ticker;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setSticky(bool $sticky): self
    {
        $this->sticky = $sticky;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setEventTime(string $eventTime): self
    {
        $this->eventTime = $eventTime;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setLocalOnly(bool $localOnly): self
    {
        $this->localOnly = $localOnly;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setNotificationPriority(string $notificationPriority): self
    {
        $this->notificationPriority = $notificationPriority;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setDefaultSound(bool $defaultSound): self
    {
        $this->defaultSound = $defaultSound;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setDefaultVibrateTimings(bool $defaultVibrateTimings): self
    {
        $this->defaultVibrateTimings = $defaultVibrateTimings;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setDefaultLightSettings(bool $defaultLightSettings): self
    {
        $this->defaultLightSettings = $defaultLightSettings;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setVibrateTimings(array $vibrateTimings): self
    {
        $this->vibrateTimings = $vibrateTimings;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setVisibility(string $visibility): self
    {
        $this->visibility = $visibility;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setNotificationCount(int $notificationCount): self
    {
        $this->notificationCount = $notificationCount;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setLightSettings(LightSettings $lightSettings): self
    {
        $this->lightSettings = $lightSettings;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function toArray(): array
    {
        $array = parent::toArray();
        $array += [
            'icon' => $this->icon,
            'color' => $this->color,
            'sound' => $this->sound,
            'tag' => $this->tag,
            'click_action' => $this->clickAction,
            'body_loc_key' => $this->bodyLocKey,
            'body_loc_args' => [
                $this->bodyLocArgs,
            ],
            'title_loc_key' => $this->titleLocKey,
            'title_loc_args' => [
                $this->titleLocArgs,
            ],
            'channel_id' => $this->channelId,
            'ticker' => $this->ticker,
            'sticky' => $this->sticky,
            'event_time' => $this->eventTime,
            'local_only' => $this->localOnly,
            'notification_priority' => $this->notificationPriority,
            'default_sound' => $this->defaultSound,
            'default_vibrate_timings' => $this->defaultVibrateTimings,
            'default_light_settings' => $this->defaultLightSettings,
            'vibrate_timings' => $this->vibrateTimings,
            'visibility' => $this->visibility,
            'notification_count' => $this->notificationCount,
            'light_settings' => $this->lightSettings,
            'image' => $this->image,
        ];

        return array_filter($array);
    }
}
