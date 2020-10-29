<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message\Notification\AndroidNotification;

class LightSettings implements \JsonSerializable
{
    /**
     * @var \Kerox\Fcm\Model\Message\Notification\AndroidNotification\Color
     */
    private $color;

    /**
     * @var string
     */
    private $lightOnDuration;

    /**
     * @var string
     */
    private $lightOffDuration;

    /**
     * LightSettings constructor.
     *
     * @param \Kerox\Fcm\Model\Message\Notification\AndroidNotification\Color $color
     */
    public function __construct(Color $color, string $lightOnDuration, string $lightOffDuration)
    {
        $this->color = $color;
        $this->lightOnDuration = $lightOnDuration;
        $this->lightOffDuration = $lightOffDuration;
    }

    public function toArray(): array
    {
        return [
            'color' => $this->color,
            'light_on_duration' => $this->lightOnDuration,
            'light_off_duration' => $this->lightOffDuration,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
