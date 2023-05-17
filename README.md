[![Tests](https://img.shields.io/github/actions/workflow/status/ker0x/fcm/ci.yml?label=tests&style=for-the-badge)](https://github.com/ker0x/fcm/actions/workflows/ci.yml)
[![Coverage](https://img.shields.io/codecov/c/gh/ker0x/fcm?style=for-the-badge)](https://codecov.io/gh/ker0x/fcm/)
![PHP Version](https://img.shields.io/badge/php->=7.3-4f5b93.svg?style=for-the-badge)
[![Download](https://img.shields.io/packagist/dt/kerox/fcm.svg?style=for-the-badge)](https://packagist.org/packages/kerox/fcm)
[![Packagist](https://img.shields.io/packagist/v/kerox/fcm.svg?style=for-the-badge)](https://packagist.org/packages/kerox/fcm)
[![License](https://img.shields.io/github/license/talesfromadev/flowbite-bundle?style=for-the-badge)](https://github.com/ker0x/fcm/blob/main/LICENSE)

# Fcm

A PHP library to send push notification with [Firebase Cloud Messaging](https://firebase.google.com/docs/cloud-messaging/)

## Warning

Version `2.x` of this library is a full rewrite to be compliant with [HTTP v1 API](https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages). If you are on Legacy HTTP API, then you should consider using version `1.x`

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
use Kerox\Fcm\Model\Message\Notification;

$fcm = new Fcm('<oauth_token>', '<project_id>');

// Create a notification
$notification = new Notification('Hello World');
$notification->setBody('My awesome Hello World!');

// Create the message
$message = new Message($notification);
$message->setData([
    'data-1' => 'Lorem ipsum',
    'data-2' => '1234',
    'data-3' => 'true'
]);
$message->setToken('1');

// Send the message and get the response
$response = $fcm->send()->message($message);
```

## Documentation

The documentation is available [here](https://github.com/ker0x/fcm/wiki)
