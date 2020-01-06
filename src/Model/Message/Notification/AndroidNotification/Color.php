<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message\Notification\AndroidNotification;

/**
 * Class Color.
 */
class Color implements \JsonSerializable
{
    /**
     * @var float
     */
    private $red;

    /**
     * @var float
     */
    private $green;

    /**
     * @var float
     */
    private $blue;

    /**
     * @var float
     */
    private $alpha;

    /**
     * Color constructor.
     */
    public function __construct(float $red, float $green, float $blue, float $alpha)
    {
        $this->red = $this->isValidValue($red);
        $this->green = $this->isValidValue($green);
        $this->blue = $this->isValidValue($blue);
        $this->alpha = $this->isValidValue($alpha);
    }

    public function toArray(): array
    {
        return [
            'red' => $this->red,
            'green' => $this->green,
            'blue' => $this->blue,
            'alpha' => $this->alpha,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    private function isValidValue(float $value): float
    {
        if ($value < 0 || $value > 1) {
            throw new \InvalidArgumentException('Value must be between 0 and 1.');
        }

        return $value;
    }
}
