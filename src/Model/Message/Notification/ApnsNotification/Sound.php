<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message\Notification\ApnsNotification;

class Sound implements \JsonSerializable
{
    public const DEFAULT_NAME = 'default';

    /**
     * @var int
     */
    private $critical = 0;

    /**
     * @var string
     */
    private $name = self::DEFAULT_NAME;

    /**
     * @var float
     */
    private $volume = 0.0;

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification\Sound
     */
    public function isCritical(bool $critical = true): self
    {
        $this->critical = (int) $critical;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification\Sound
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Model\Message\Notification\ApnsNotification\Sound
     */
    public function setVolume(float $volume): self
    {
        $this->volume = $volume;

        return $this;
    }

    public function toArray(): array
    {
        $array = [
            'critical' => $this->critical,
            'name' => $this->name,
            'volume' => $this->volume,
        ];

        return array_filter($array);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
