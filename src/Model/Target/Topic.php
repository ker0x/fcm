<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Target;

final readonly class Topic implements \Stringable
{
    public function __construct(private string $topic)
    {
    }

    public function __toString(): string
    {
        return $this->topic;
    }
}
