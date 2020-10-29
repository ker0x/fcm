<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message;

use Kerox\Fcm\Helper\ValidatorTrait;
use Kerox\Fcm\Model\Message\Notification\AndroidNotification;
use Kerox\Fcm\Model\Message\Options\AndroidOptions;

class Android implements \JsonSerializable
{
    use ValidatorTrait;

    public const PRIORITY_NORMAL = 'normal';
    public const PRIORITY_HIGH = 'high';

    /**
     * @var string|null
     */
    private $collapseKey;

    /**
     * @var string
     */
    private $priority = self::PRIORITY_NORMAL;

    /**
     * @var string|null
     */
    private $ttl;

    /**
     * @var string|null
     */
    private $restrictedPackageName;

    /**
     * @var array
     */
    private $data = [];

    /**
     * @var \Kerox\Fcm\Model\Message\Notification\AndroidNotification|null
     */
    private $notification;

    /**
     * @var \Kerox\Fcm\Model\Message\Options\AndroidOptions
     */
    private $options;

    /**
     * @var bool|null
     */
    private $directBootOk;

    /**
     * @return \Kerox\Fcm\Model\Message\Android
     */
    public function setCollapseKey(string $collapseKey): self
    {
        $this->collapseKey = $collapseKey;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Android
     */
    public function setPriority(string $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Android
     */
    public function setTtl(string $ttl): self
    {
        $this->isValidTtl($ttl);

        $this->ttl = $ttl;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Android
     */
    public function setRestrictedPackageName(string $restrictedPackageName): self
    {
        $this->restrictedPackageName = $restrictedPackageName;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Android
     */
    public function setData(array $data): self
    {
        $this->isValidData($data);

        $this->data = $data;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Android
     */
    public function setNotification(AndroidNotification $notification): self
    {
        $this->notification = $notification;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Android
     */
    public function setOptions(AndroidOptions $options): self
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Android
     */
    public function setDirectBootOk(bool $directBootOk): self
    {
        $this->directBootOk = $directBootOk;

        return $this;
    }

    public function toArray(): array
    {
        $array = [
            'collapse_key' => $this->collapseKey,
            'priority' => $this->priority,
            'ttl' => $this->ttl,
            'restricted_package_name' => $this->restrictedPackageName,
            'data' => $this->data,
            'notification' => $this->notification,
            'fcm_options' => $this->options,
            'direct_boot_ok' => $this->directBootOk,
        ];

        return array_filter($array);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
