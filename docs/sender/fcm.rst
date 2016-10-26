Fcm Sender
==========

Introduction
------------

You have three methods available to send push notification:

    - ``sendTo($targets)`` to send downstream message.
    - ``sendToTopic($topic)`` to send topic message.
    - ``sendToGroup($group)`` to send group message.

Where:

    - ``$target`` is a string or an array of devices's tokens. (required)
    - ``$topic`` is a topic or conditions of topics. (required)
    - ``$group`` is a group. (required)


Global
------

.. code:: php

    use Kerox\Fcm;

    $fcm = new Fcm($apiKey);
    $fcm->setNotification($notification)
        ->setData($data)
        ->setOptions($options);

Where:

    - ``$apiKey`` is your FCM API key.
    - ``$notification`` can be an NotificationBuilder object or an array containing the notification. (optional)
    - ``$data`` can be a DataBuilder object or an array with some data that will be passed. (optional)
    - ``$options`` can be an OptionsBuilder object or an array of options for the payload. (optional)

If you passed arrays to ``setNotification()``, ``setData()``, or ``setOptions``, their will be converted to builder object.

Downstream Message
------------------

.. code:: php

    $fcm->sendTo($target);

Topic Message
-------------

.. code:: php

    $fcm->sendToTopic($topic);

Group Message
-------------

.. code:: php

    $fcm->sendToGroup($group);

For more details on sending message, refer to the `FCM documentation <https://firebase.google.com/docs/cloud-messaging/http-server-ref>`__