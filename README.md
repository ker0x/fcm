<div align="center">
    <a href="https://github.com/ker0x/fcm/actions?query=workflow%3Aci" title="CI">
        <img src="https://img.shields.io/github/workflow/status/ker0x/fcm/ci?style=for-the-badge" alt="CI">
    </a>
    <a href="https://codecov.io/gh/ker0x/fcm/" title="Coverage">
        <img src="https://img.shields.io/codecov/c/gh/ker0x/fcm?style=for-the-badge" alt="Coverage">
    </a>
    <a href="https://php.net" title="PHP Version">
        <img src="https://img.shields.io/badge/php-%3E%3D%207.4-8892BF.svg?style=for-the-badge" alt="PHP Version">
    </a>
    <a href="https://packagist.org/packages/kerox/fcm" title="Downloads">
        <img src="https://img.shields.io/packagist/dt/kerox/fcm.svg?style=for-the-badge" alt="Downloads">
    </a>
    <a href="https://packagist.org/packages/kerox/fcm" title="Latest Stable Version">
        <img src="https://img.shields.io/packagist/v/kerox/fcm.svg?style=for-the-badge" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/kerox/fcm" title="License">
        <img src="https://img.shields.io/packagist/l/kerox/fcm.svg?style=for-the-badge" alt="License">
    </a>
</div>

# Fcm

A PHP libray to send push notification with [Firebase Cloud Messaging](https://firebase.google.com/docs/cloud-messaging/)

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
