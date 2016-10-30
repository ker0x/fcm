Group Response
==============

Introduction
------------

To get the response of a group request, just save the return of the ``sendToGroup()`` method into a variable.

.. code:: php

    $response = $fcm->sendToGroup($group);


You have three methods available to read downstream response:

- ``getNumberSuccess()``: Return the number of messages that were processed without an error.

.. code:: php

    $response->getNumberSuccess();


- ``getNumberFailure()``: Return the number of messages that could not be processed.

.. code:: php

    $response->getNumberFailure();


- ``getTargetsFailed()``: Return a lists of registration tokens that failed to receive the message.

.. code:: php

    $response->getTargetsFailed();


For more details on group response, refer to the `Device Group Messaging documentation <https://firebase.google.com/docs/cloud-messaging/android/device-group#http_response>`__
