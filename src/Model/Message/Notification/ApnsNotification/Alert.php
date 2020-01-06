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
     * @var string|null
     */
    private $subTitle;

    /**
     * @var string|null
     */
    private $launchImage;

    /**
     * @var string|null
     */
    private $titleLocKey;

    /**
     * @var array
     */
    private $titleLocArgs = [];

    /**
     * @var string|null
     */
    private $subTitleLocKey;

    /**
     * @var array
     */
    private $subTitleLocArgs = [];

    /**
     * @var string|null
     */
    private $locKey;

    /**
     * @var array
     */
    private $locArgs = [];

    /**
     * @var string|null
     */
    private $actionLocKey;

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert
     */
    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert
     */
    public function setSubTitle(string $subTitle): self
    {
        $this->subTitle = $subTitle;

        return $this;
    }

    /**
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
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert
     */
    public function setSubTitleLocKey(string $subTitleLocKey): self
    {
        $this->subTitleLocKey = $subTitleLocKey;

        return $this;
    }

    /**
     * @param string[] $subTitleLocArgs
     *
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert
     */
    public function setSubTitleLocArgs(array $subTitleLocArgs): self
    {
        $this->subTitleLocArgs = $subTitleLocArgs;

        return $this;
    }

    /**
     * @deprecated since 2.1 and will be removed in 3.0
     *
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert
     */
    public function setActionLocKey(string $actionLocKey): self
    {
        $this->actionLocKey = $actionLocKey;

        return $this;
    }

    /**
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
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert
     */
    public function setLaunchImage(string $launchImage): self
    {
        $this->launchImage = $launchImage;

        return $this;
    }

    public function toArray(): array
    {
        $json = parent::toArray();
        $json += [
            'subtitle' => $this->subTitle,
            'launch-image' => $this->launchImage,
            'title-loc-key' => $this->titleLocKey,
            'title-loc-args' => $this->titleLocArgs,
            'subtitle-loc-key' => $this->subTitleLocKey,
            'subtitle-loc-args' => $this->subTitleLocArgs,
            'loc-key' => $this->locKey,
            'loc-args' => $this->locArgs,
            'action-loc-key' => $this->actionLocKey,
        ];

        return array_filter($json);
    }
}
