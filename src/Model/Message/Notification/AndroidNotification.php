<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message\Notification;

use Kerox\Fcm\Model\Message\AbstractNotification;

/**
 * Class AndroidNotification.
 */
class AndroidNotification extends AbstractNotification
{
    /**
     * @var null|string
     */
    protected $icon;

    /**
     * @var null|string
     */
    protected $color;

    /**
     * @var null|string
     */
    protected $sound;

    /**
     * @var null|string
     */
    protected $tag;

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
     * @param string $title
     *
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param string $body
     *
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @param string $icon
     *
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @param string $color
     *
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @param string $sound
     *
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setSound(string $sound): self
    {
        $this->sound = $sound;

        return $this;
    }

    /**
     * @param string $tag
     *
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setTag(string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @param string $clickAction
     *
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setClickAction(string $clickAction): self
    {
        $this->clickAction = $clickAction;

        return $this;
    }

    /**
     * @param string $bodyLocKey
     *
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setBodyLocKey(string $bodyLocKey): self
    {
        $this->bodyLocKey = $bodyLocKey;

        return $this;
    }

    /**
     * @param string $bodyLocArgs
     *
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setBodyLocArgs(string $bodyLocArgs): self
    {
        $this->bodyLocArgs = $bodyLocArgs;

        return $this;
    }

    /**
     * @param string $titleLocKey
     *
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setTitleLocKey(string $titleLocKey): self
    {
        $this->titleLocKey = $titleLocKey;

        return $this;
    }

    /**
     * @param string $titleLocArgs
     *
     * @return \Kerox\Fcm\Model\Message\Notification\AndroidNotification
     */
    public function setTitleLocArgs(string $titleLocArgs): self
    {
        $this->titleLocArgs = $titleLocArgs;

        return $this;
    }

    /**
     * @return array
     */
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
        ];

        return array_filter($array);
    }
}
