<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message;

/**
 * Interface NotificationInterface.
 */
interface NotificationInterface
{
    /**
     * @param string $body
     */
    public function setBody(string $body);
}
