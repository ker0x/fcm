<?php

declare(strict_types=1);

namespace Kerox\Fcm\Enum;

/**
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#visibility
 */
enum Visibility: string
{
    case Unspecified = 'VISIBILITY_UNSPECIFIED';
    case Private = 'PRIVATE';
    case Public = 'PUBLIC';
    case Secret = 'SECRET';
}
