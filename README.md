[![Tests](https://img.shields.io/github/actions/workflow/status/ker0x/fcm/ci.yml?label=tests&style=for-the-badge)](https://github.com/ker0x/fcm/actions/workflows/ci.yml)
[![Coverage](https://img.shields.io/codecov/c/gh/ker0x/fcm?style=for-the-badge)](https://codecov.io/gh/ker0x/fcm/)
![PHP Version](https://img.shields.io/badge/php->=8.2-4f5b93.svg?style=for-the-badge)
[![Download](https://img.shields.io/packagist/dt/kerox/fcm.svg?style=for-the-badge)](https://packagist.org/packages/kerox/fcm)
[![Packagist](https://img.shields.io/packagist/v/kerox/fcm.svg?style=for-the-badge)](https://packagist.org/packages/kerox/fcm)
[![License](https://img.shields.io/github/license/talesfromadev/flowbite-bundle?style=for-the-badge)](https://github.com/ker0x/fcm/blob/main/LICENSE)

# Fcm

A PHP library to send push notification with [Firebase Cloud Messaging](https://firebase.google.com/docs/cloud-messaging/)

## Warning

Version `3.x` of this library is a full rewrite using [PSR-18 HTTP Client](https://www.php-fig.org/psr/psr-18/) interface, 
which means that **no** HTTP Client, like [Guzzle](https://github.com/guzzle/guzzle) or [httplug](https://github.com/php-http/httplug), 
are provided within. If you already have one in your project, the package will **automatically discover it** and use it.
Otherwise You will need to require one separately.

## Installation

You can install Fcm using Composer:

```
composer require kerox/fcm
```

You will then need to:
* run `composer install` to get these dependencies added to your vendor directory
* add the autoloader to your application with this line: `require('vendor/autoload.php');`

## Basic usage

```php
use Kerox\Fcm\Fcm;
use Kerox\Fcm\Model\Message;
use Kerox\Fcm\Model\Notification\Notification;
use Kerox\Fcm\Model\Target;

$fcm = new Fcm('<oauth_token>', '<project_id>');

// Create the message
$message = new Message(
    notification: new Notification(
        title: 'Hello World',
        body: 'My awesome Hello World!'
    ),
    target: new Token('TopicA'),
    data: [
        'story_id' => 'story_12345',
    ],
)

// Send the message and get the response
$response = $fcm->send()->message($message);
```

## Documentation

The documentation is available [here](https://github.com/ker0x/fcm/wiki)
