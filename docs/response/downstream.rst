Downstream Response
===================

Introduction
------------

To get the response of a downstream request, just save the return of the ``sendTo()`` method into a variable.

.. code:: php

    $response = $fcm->sendTo(['1', '2', '3', '4']);


You have seven methods available to read downstream response:

- ``getNumberSuccess()`` return the number of messages that were processed without an error.

.. code:: php

    $response->getNumberSuccess();

- ``getNumberFailure()`` return the number of messages that could not be processed.

.. code:: php

    $response->getNumberFailure();


- ``getNumberModify()`` return the number of results that contain a canonical registration token.

.. code:: php

    $response->getNumberModify();


- ``getTargetsToDelete()`` return an array of tokens that you should remove in your database.

.. code:: php

    $response->getTargetsToDelete();


- ``getTargetsToModify()`` return an array of tokens (key : old token, value : new token) that you should change in your database.

.. code:: php

    $response->getTargetsToModify();


- ``getTargetsToRetry()`` return an array of tokens you should try to resend the message.

.. code:: php

    $response->getTargetsToRetry();


- ``getTargetsWithError()`` return an array of tokens that could not be processed with their error.

.. code:: php

    $response->getTargetsWithError();

For more details on downstream response, refer to the `FCM documentation <https://firebase.google.com/docs/cloud-messaging/http-server-ref#interpret-downstream>`__
