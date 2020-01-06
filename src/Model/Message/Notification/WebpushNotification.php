<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message\Notification;

use Kerox\Fcm\Helper\ValidatorTrait;
use Kerox\Fcm\Model\Message\AbstractNotification;

class WebpushNotification extends AbstractNotification
{
    use ValidatorTrait;

    public const PERMISSION_DENIED = 'denied';
    public const PERMISSION_GRANTED = 'granted';
    public const PERMISSION_DEFAULT = 'default';

    public const DIR_AUTO = 'auto';
    public const DIR_LTR = 'ltr';
    public const DIR_RTL = 'rtl';

    /**
     * @var string
     */
    protected $permission = self::PERMISSION_DEFAULT;

    /**
     * @var array
     */
    protected $actions = [];

    /**
     * @var string|null
     */
    protected $badge;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * @var string
     */
    protected $dir = self::DIR_AUTO;

    /**
     * @var string|null
     */
    protected $lang;

    /**
     * @var string|null
     */
    protected $tag;

    /**
     * @var string|null
     */
    protected $icon;

    /**
     * @var string|null
     */
    protected $image;

    /**
     * @var bool
     */
    protected $renotify = false;

    /**
     * @var bool
     */
    protected $requireInteraction = false;

    /**
     * @var bool
     */
    protected $silent = false;

    /**
     * @var int|null
     */
    protected $timestamp;

    /**
     * @var array
     */
    protected $vibrate = [];

    /**
     * @var bool
     */
    protected $sticky = false;

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\WebpushNotification
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\WebpushNotification
     */
    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return WebpushNotification
     */
    public function setPermission(string $permission): self
    {
        $this->permission = $permission;

        return $this;
    }

    /**
     * @return WebpushNotification
     */
    public function setActions(array $actions): self
    {
        $this->actions = $actions;

        return $this;
    }

    /**
     * @return WebpushNotification
     */
    public function setBadge(string $badge): self
    {
        $this->isValidUrl($badge);

        $this->badge = $badge;

        return $this;
    }

    /**
     * @param mixed $data
     *
     * @return WebpushNotification
     */
    public function setData($data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return WebpushNotification
     */
    public function setDir(string $dir): self
    {
        $this->dir = $dir;

        return $this;
    }

    /**
     * @return WebpushNotification
     */
    public function setLang(string $lang): self
    {
        $this->isValidLang($lang);

        $this->lang = $lang;

        return $this;
    }

    /**
     * @return WebpushNotification
     */
    public function setTag(string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return WebpushNotification
     */
    public function setIcon(string $icon): self
    {
        $this->isValidUrl($icon);

        $this->icon = $icon;

        return $this;
    }

    /**
     * @return WebpushNotification
     */
    public function setImage(string $image): self
    {
        $this->isValidUrl($image);

        $this->image = $image;

        return $this;
    }

    /**
     * @return WebpushNotification
     */
    public function setRenotify(bool $renotify): self
    {
        $this->renotify = $renotify;

        return $this;
    }

    /**
     * @return WebpushNotification
     */
    public function setRequireInteraction(bool $requireInteraction): self
    {
        $this->requireInteraction = $requireInteraction;

        return $this;
    }

    /**
     * @return WebpushNotification
     */
    public function setSilent(bool $silent): self
    {
        $this->silent = $silent;

        return $this;
    }

    /**
     * @return WebpushNotification
     */
    public function setTimestamp(\DateTime $dateTime): self
    {
        $this->timestamp = $dateTime->getTimestamp();

        return $this;
    }

    /**
     * @return WebpushNotification
     */
    public function setVibrate(array $vibratePattern): self
    {
        $this->isValidVibratePattern($vibratePattern);

        $this->vibrate = $vibratePattern;

        return $this;
    }

    /**
     * @return WebpushNotification
     */
    public function setSticky(bool $sticky): self
    {
        $this->sticky = $sticky;

        return $this;
    }

    public function toArray(): array
    {
        $array = parent::toArray();
        $array += [
            'permission' => $this->permission,
            'actions' => $this->actions,
            'badge' => $this->badge,
            'data' => $this->data,
            'dir' => $this->dir,
            'lang' => $this->lang,
            'tag' => $this->tag,
            'icon' => $this->icon,
            'image' => $this->image,
            'renotify' => $this->renotify,
            'requireInteraction' => $this->requireInteraction,
            'silent' => $this->silent,
            'timestamp' => $this->timestamp,
            'vibrate' => $this->vibrate,
            'sticky' => $this->sticky,
        ];

        return array_filter($array);
    }
}
