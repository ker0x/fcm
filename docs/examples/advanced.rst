Advanced Examples
=================

Downstream message
------------------

Sending a downstream message using builders.

.. code:: php

    use Kerox\Fcm\Fcm;
    use Kerox\Fcm\Message\DataBuilder;
    use Kerox\Fcm\Message\NotificationBuilder;
    use Kerox\Fcm\Message\OptionsBuilder;

    // Create the notification
    $notificationBuilder = new NotificationBuilder('Hello World');
    $notificationBuilder
        ->setBody('My awesome Hello World');
        ->setSound('sound')
        ->setBadge('badge')
        ->setIcon('icon')
        ->setTag('tag')
        ->setColor('#FFFFFF')
        ->setClickAction('click_action')
        ->setBodyLocKey('body_loc_key')
        ->setBodyLocArgs('body_loc_args')
        ->setTitleLocKey('title_loc_key')
        ->setTitleLocArgs('title_loc_args')

    // Create the data
    $dataBuilder = new DataBuilder();
    $dataBuilder
        ->setData('data-1', 'data-1')
        ->setData('data-2', true)
        ->setData('data-3', 1234);

    // Create the options
    $optionsBuilder = new OptionsBuilder();
    $optionsBuilder
        ->setCollapseKey('Update available')
        ->setPriority('normal')
        ->setTimeToLive(3600)
        ->setContentAvailable(true)
        ->setDryRun(true);

    // Build
    $notification = $notificationBuilder->build();
    $data = $dataBuilder->build();
    $options = $optionsBuilder->build();

    $fcm = new Fcm($this->api_key);
    $fcm->setNotification($notification)
        ->setData($data)
        ->setOptions($options);

    $response = $fcm->sendTo(['1', '2', '3', '4']);


Sending a topic message using builders.

.. code:: php

    use Kerox\Fcm\Fcm;
    use Kerox\Fcm\Message\DataBuilder;
    use Kerox\Fcm\Message\NotificationBuilder;
    use Kerox\Fcm\Message\OptionsBuilder;
    use Kerox\Fcm\Message\TopicsBuilder;

    // Create topics
    $topicBuilder = new TopicBuilder('My first topic');
    $topicsBuilder->andTopic(function () {
        return new TopicsBuilder('My second topic')->orTopic('My third topic');
    })

    // Create the notification
    $notificationBuilder = new NotificationBuilder('Hello World');
    $notificationBuilder
        ->setBody('My awesome Hello World');
        ->setSound('sound')
        ->setBadge('badge')
        ->setIcon('icon')
        ->setTag('tag')
        ->setColor('#FFFFFF')
        ->setClickAction('click_action')
        ->setBodyLocKey('body_loc_key')
        ->setBodyLocArgs('body_loc_args')
        ->setTitleLocKey('title_loc_key')
        ->setTitleLocArgs('title_loc_args')

    // Create the data
    $dataBuilder = new DataBuilder();
    $dataBuilder
        ->setData('data-1', 'data-1')
        ->setData('data-2', true)
        ->setData('data-3', 1234);

    // Create the options
    $optionsBuilder = new OptionsBuilder();
    $optionsBuilder
        ->setCollapseKey('Update available')
        ->setPriority('normal')
        ->setTimeToLive(3600)
        ->setContentAvailable(true)
        ->setDryRun(true);

    // Build
    $notification = $notificationBuilder->build();
    $data = $dataBuilder->build();
    $options = $optionsBuilder->build();
    $topic = $topicBuilder->build();

    $fcm = new Fcm($this->api_key);
    $fcm->setNotification($notification)
        ->setData($data)
        ->setOptions($options);

    $response = $fcm->sendToTopic($topic);