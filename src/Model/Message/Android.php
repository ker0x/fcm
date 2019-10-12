<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message;

use Kerox\Fcm\Helper\ValidatorTrait;
use Kerox\Fcm\Model\Message\Notification\AndroidNotification;

class Android implements \JsonSerializable
{
    use ValidatorTrait;

    public const PRIORITY_NORMAL = 'normal';
    public const PRIORITY_HIGH = 'high';

    /**
     * @var string|null
     */
    protected $collapseKey;

    /**
     * @var string
     */
    protected $priority = self::PRIORITY_NORMAL;

    /**
     * @var string|null
     */
    protected $ttl;

    /**
     * @var string|null
     */
    protected $restrictedPackageName;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var \Kerox\Fcm\Model\Message\Notification\AndroidNotification|null
     */
    protected $notification;

    /**
     * @param string $collapseKey
     *
     * @return \Kerox\Fcm\Model\Message\Android
     */
    public function setCollapseKey(string $collapseKey): self
    {
        $this->collapseKey = $collapseKey;

        return $this;
    }

    /**
     * @param string $priority
     *
     * @return \Kerox\Fcm\Model\Message\Android
     */
    public function setPriority(string $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @param string $ttl
     *
     * @return \Kerox\Fcm\Model\Message\Android
     */
    public function setTtl(string $ttl): self
    {
        $this->isValidTtl($ttl);

        $this->ttl = $ttl;

        return $this;
    }

    /**
     * @param string $restrictedPackageName
     *
     * @return \Kerox\Fcm\Model\Message\Android
     */
    public function setRestrictedPackageName(string $restrictedPackageName): self
    {
        $this->restrictedPackageName = $restrictedPackageName;

        return $this;
    }

    /**
     * @param array $data
     *
     * @return \Kerox\Fcm\Model\Message\Android
     */
    public function setData(array $data): self
    {
        $this->isValidData($data);

        $this->data = $data;

        return $this;
    }

    /**
     * @param \Kerox\Fcm\Model\Message\Notification\AndroidNotification $notification
     *
     * @return \Kerox\Fcm\Model\Message\Android
     */
    public function setNotification(AndroidNotification $notification): self
    {
        $this->notification = $notification;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [
            'collapse_key' => $this->collapseKey,
            'priority' => $this->priority,
            'ttl' => $this->ttl,
            'restricted_package_name' => $this->restrictedPackageName,
            'data' => $this->data,
            'notification' => $this->notification,
        ];

        return array_filter($array);
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
