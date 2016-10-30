Basic Examples
==============

Downstream message
------------------

Sending a downstream message from arrays.

.. code:: php

    use Kerox\Fcm;

    // Create a downstream message from arrays
    $fcm = new Fcm('YOUR_FCM_API_KEY');
    $fcm->setNotification([
            'title' => 'Hello World',
            'body' => 'My awesome Hello World!'
        ])
        ->setData([
            'data-1' => 'Lorem ipsum',
            'data-2' => 1234,
            'data-3' => true
        ])
        ->setOptions([
            'dry_run' => true
        ]);

    // Send the message and get the response
    $response = $fcm->sendTo(['1', '2', '3', '4']);


Topic message
-------------

Sending a topic message from arrays.

.. code:: php

    use Kerox\Fcm;
    use Kerox\Fcm\Message\TopicBuilder;

    $topicBuilder = new TopicBuilder('myTopic');
    $topic = $topicBuilder->build();

    // Create a downstream message from arrays
    $fcm = new Fcm('YOUR_FCM_API_KEY');
    $fcm->setNotification([
            'title' => 'Hello World',
            'body' => 'My awesome Hello World!'
        ])
        ->setData([
            'data-1' => 'Lorem ipsum',
            'data-2' => 1234,
            'data-3' => true
        ])
        ->setOptions([
            'dry_run' => true
        ]);

    // Send the message and get the response
    $response = $fcm->sendToTopic($topic);