Group Sender
============

Introduction
------------

You have three methods available to manage group:

    - ``createGroup($groupName, $devicesToken)`` to create a group.
    - ``addToGroup($groupName, $notificationKey, $devicesToken)`` to add one or more devices to a group.
    - ``removeFromGroup($groupName, $notificationKey, $devicesToken)`` to remove one or more devices from a group.

Where:

    - ``$groupName`` is a string containing the name of the group.
    - ``$deviceToken`` can be a string or an array containing devices's token.
    - ``$notificationKey`` is the notification key return by the request.

A successful request returns a notification_key like the following:

.. code:: json

    {
       "notification_key": "APA91bGHXQBB...9QgnYOEURwm0I3lmyqzk2TXQ"
    }

Global
------

.. code:: php

    use Kerox\FcmGroup;

    $fcmGroup = new FcmGroup($apiKey, $senderId);

Where:

    - ``$apiKey`` is your FCM API key. (required)
    - ``$senderId`` is your sender ID. (required)

Creating a group
----------------

.. code:: php

    $notificationKey = $fcmGroup->createGroup('myGroup', $deviceToken);

Adding devices to a group
-------------------------

.. code:: php

    $notificationKey = $fcmGroup->addToGroup('myGroup', $notificationKey, $deviceToken)

Removing devices from a group
-----------------------------

.. code:: php

    $notificationKey = $fcmGroup->removeFromGroup('myGroup', $notificationKey, $deviceToken)


For more details on group in Firebase, refer to the `Firebase documentation <https://firebase.google.com/docs/cloud-messaging/android/device-group>`__