<?php

declare(strict_types=1);

namespace Kerox\Fcm\Enum;

enum Permission: string
{
    case Denied = 'denied';
    case Granted = 'granted';
    case Default = 'default';
}
