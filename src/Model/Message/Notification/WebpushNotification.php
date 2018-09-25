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
     * @var null|string
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
     * @var null|string
     */
    protected $lang;

    /**
     * @var null|string
     */
    protected $tag;

    /**
     * @var null|string
     */
    protected $icon;

    /**
     * @var null|string
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
     * @var null|int
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
     * @param string $title
     *
     * @return \Kerox\Fcm\Model\Message\Notification\WebpushNotification
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param string $body
     *
     * @return \Kerox\Fcm\Model\Message\Notification\WebpushNotification
     */
    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @param string $permission
     *
     * @return WebpushNotification
     */
    public function setPermission(string $permission): self
    {
        $this->permission = $permission;

        return $this;
    }

    /**
     * @param array $actions
     *
     * @return WebpushNotification
     */
    public function setActions(array $actions): self
    {
        $this->actions = $actions;

        return $this;
    }

    /**
     * @param string $badge
     *
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
     * @param string $dir
     *
     * @return WebpushNotification
     */
    public function setDir(string $dir): self
    {
        $this->dir = $dir;

        return $this;
    }

    /**
     * @param string $lang
     *
     * @return WebpushNotification
     */
    public function setLang(string $lang): self
    {
        $this->isValidLang($lang);

        $this->lang = $lang;

        return $this;
    }

    /**
     * @param string $tag
     *
     * @return WebpushNotification
     */
    public function setTag(string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @param string $icon
     *
     * @return WebpushNotification
     */
    public function setIcon(string $icon): self
    {
        $this->isValidUrl($icon);

        $this->icon = $icon;

        return $this;
    }

    /**
     * @param string $image
     *
     * @return WebpushNotification
     */
    public function setImage(string $image): self
    {
        $this->isValidUrl($image);

        $this->image = $image;

        return $this;
    }

    /**
     * @param bool $renotify
     *
     * @return WebpushNotification
     */
    public function setRenotify(bool $renotify): self
    {
        $this->renotify = $renotify;

        return $this;
    }

    /**
     * @param bool $requireInteraction
     *
     * @return WebpushNotification
     */
    public function setRequireInteraction(bool $requireInteraction): self
    {
        $this->requireInteraction = $requireInteraction;

        return $this;
    }

    /**
     * @param bool $silent
     *
     * @return WebpushNotification
     */
    public function setSilent(bool $silent): self
    {
        $this->silent = $silent;

        return $this;
    }

    /**
     * @param \DateTime $dateTime
     *
     * @return WebpushNotification
     */
    public function setTimestamp(\DateTime $dateTime): self
    {
        $this->timestamp = $dateTime->getTimestamp();

        return $this;
    }

    /**
     * @param array $vibratePattern
     *
     * @return WebpushNotification
     */
    public function setVibrate(array $vibratePattern): self
    {
        $this->isValidVibratePattern($vibratePattern);

        $this->vibrate = $vibratePattern;

        return $this;
    }

    /**
     * @param bool $sticky
     *
     * @return WebpushNotification
     */
    public function setSticky(bool $sticky): self
    {
        $this->sticky = $sticky;

        return $this;
    }

    /**
     * @return array
     */
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
