Notification Builder
====================

Introduction
------------

You can build a notification by using the NotificationBuilder class.

Usage
-----

.. code:: php

    use Kerox\Message\NotificationBuilder;

    $notificationBuilder = new NotificationBuilder('Hello World');
    $notificationBuilder
        ->setBody('body')
        ->setSound('sound')
        ->setBadge('badge')
        ->setIcon('icon')
        ->setTag('tag')
        ->setColor('#FFFFFF')
        ->setClickAction('click_action')
        ->setBodyLocKey('body_loc_key')
        ->setBodyLocArgs('body_loc_args')
        ->setTitleLocKey('title_loc_key')
        ->setTitleLocArgs('title_loc_args');
