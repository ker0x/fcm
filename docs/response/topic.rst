Topic Response
==============

Introduction
------------

To get the response of a topic request, just save the return of the ``sendToTopic()`` method into a variable.

.. code:: php

    $response = $fcm->sendToTopic($topic);


You have three methods available to read downstream response:

- ``isSuccess()``: Return ``true`` if topic was sent with success.

.. code:: php

    $response->isSuccess();

- ``shouldRetry()``: Return ``true`` if topic must be resent.

.. code:: php

    $response->shouldRetry();


- ``getError()``: Return the error message if topic couldn't be sent.

.. code:: php

    $response->getError();


For more details on topic response, refer to the `FCM documentation <https://firebase.google.com/docs/cloud-messaging/http-server-ref#interpret-downstream>`__

