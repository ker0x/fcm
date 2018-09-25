<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message\Notification\ApnsNotification;

use Kerox\Fcm\Model\Message\AbstractNotification;

/**
 * Class Alert.
 */
class Alert extends AbstractNotification
{
    /**
     * @var null|string
     */
    protected $titleLocKey;

    /**
     * @var array
     */
    protected $titleLocArgs = [];

    /**
     * @var null|string
     */
    protected $actionLocKey;

    /**
     * @var null|string
     */
    protected $locKey;

    /**
     * @var array
     */
    protected $locArgs = [];

    /**
     * @var null|string
     */
    protected $launchImage;

    /**
     * @param string $title
     *
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param string $body
     *
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert
     */
    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @param mixed $titleLocKey
     *
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert
     */
    public function setTitleLocKey(string $titleLocKey): self
    {
        $this->titleLocKey = $titleLocKey;

        return $this;
    }

    /**
     * @param string[] $titleLocArgs
     *
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert
     */
    public function setTitleLocArgs(array $titleLocArgs): self
    {
        $this->titleLocArgs = $titleLocArgs;

        return $this;
    }

    /**
     * @param string $actionLocKey
     *
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert
     */
    public function setActionLocKey(string $actionLocKey): self
    {
        $this->actionLocKey = $actionLocKey;

        return $this;
    }

    /**
     * @param string $locKey
     *
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert
     */
    public function setLocKey(string $locKey): self
    {
        $this->locKey = $locKey;

        return $this;
    }

    /**
     * @param string[] $locArgs
     *
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert
     */
    public function setLocArgs(array $locArgs): self
    {
        $this->locArgs = $locArgs;

        return $this;
    }

    /**
     * @param string $launchImage
     *
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert
     */
    public function setLaunchImage(string $launchImage): self
    {
        $this->launchImage = $launchImage;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $json = parent::toArray();
        $json += [
            'title-loc-key' => $this->titleLocKey,
            'title-loc-args' => $this->titleLocArgs,
            'action-loc-key' => $this->actionLocKey,
            'loc-key' => $this->locKey,
            'loc-args' => $this->locArgs,
            'launch-image' => $this->launchImage,
        ];

        return array_filter($json);
    }
}
