Usage
=====

Introduction
------------

It currently only supports HTTP protocol for :

    - sending a downstream message to one or multiple devices
    - managing groups and sending message to a group
    - sending topics messages


Configuration
-------------

First, you have to get an API key. Go to https://console.firebase.google.com/ , create a project then in your project's settings you will see your Web API Key.


Send a downstream message
-------------------------

.. code:: php

    use Kerox\Fcm\Fcm;
    use Kerox\Fcm\Message\DataBuilder;
    use Kerox\Fcm\Message\NotificationBuilder;
    use Kerox\Fcm\Message\OptionsBuilder;

    // Build notification
    $notificationBuilder = new NotificationBuilder('Hello World');
    $notificationBuilder
        ->setBody('My awesome Hello World');
        ->setSound('sound')
        ->setBadge('badge')
        ->setIcon('icon')
        ->setTag('tag')
        ->setColor('#FFFFFF')

    // Build data
    $dataBuilder = new DataBuilder();
    $dataBuilder
        ->setData('data-1', 'data-1')
        ->setData('data-2', true)
        ->setData('data-3', 1234);

    // Build option
    $optionsBuilder = new OptionsBuilder();
    $optionsBuilder
        ->setCollapseKey('Update available')
        ->setPriority('normal')
        ->setTimeToLive(3600);

    $notification = $notificationBuilder->build();
    $data = $dataBuilder->build();
    $options = $optionsBuilder->build();

    $fcm = new Fcm('YOUR_API_KEY');
    $fcm->setNotification($notification)
        ->setData($data)
        ->setOptions($options);

    $response = $fcm->sendTo('TARGETS');

    $response->getNumberSuccess();
    $response->getNumberFailure();
    $response->getNumberModify();

    $response->getTargetsToDelete();
    $response->getTargetsToModify();
    $response->getTargetsToRetry();
    $response->getTargetsWithError();
