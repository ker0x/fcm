<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Target;

final readonly class Token implements \Stringable
{
    public function __construct(private string $token)
    {
    }

    public function __toString(): string
    {
        return $this->token;
    }
}
