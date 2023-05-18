<?php

declare(strict_types=1);

namespace Kerox\Fcm\Enum;

/**
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#androidmessagepriority
 */
enum AndroidMessagePriority: string
{
    case Normal = 'normal';
    case High = 'high';
}
