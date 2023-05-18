<?php

declare(strict_types=1);

namespace Kerox\Fcm\Enum;

/**
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages?#notificationpriority
 */
enum NotificationPriority: string
{
    case Unspecified = 'PRIORITY_UNSPECIFIED';
    case Min = 'PRIORITY_MIN';
    case Low = 'PRIORITY_LOW';
    case Default = 'PRIORITY_DEFAULT';
    case High = 'PRIORITY_HIGH';
    case Max = 'PRIORITY_MAX';
}
