<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message;

interface NotificationInterface
{
    public function setBody(string $body);
}
