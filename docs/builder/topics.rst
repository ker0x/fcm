Topics Builder
==============

Introduction
------------

You can build topics by using the TopicsBuilder class.


Usage
-----

.. code:: php

    use Kerox\Message\TopicsBuilder;

    $topicsBuilder = new TopicsBuilder('Topic A');


AND condition
-------------

.. code:: php

    $topicsBuilder->andTopic('Topic B');

Result: ``'Topic A' in topics && 'Topic B' in topics``


OR condition
------------

.. code:: php

    $topicsBuilder->orTopic('Topic B');

Result: ``'Topic A' in topics || 'Topic B' in topics``


Subcondition
------------

.. code:: php

    $topicsBuilder->andTopic(function () {
        return new TopicsBuilder('Topic B')->orTopic('Topic C');
    })

Result: ``'Topic A' in topics && ('Topic B' in topics || 'Topic C' in topics)``
