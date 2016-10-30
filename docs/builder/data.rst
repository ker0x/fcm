Data Builder
============

Introduction
------------

You can build data by using the DataBuilder class.


Usage
-----

.. code:: php

    use Kerox\Message\DataBuilder;

    $dataBuilder = new DataBuilder();


Adding datas

.. code:: php

    $dataBuilder
        ->setData('data-1', 'data-1')
        ->setData('data-2', true)
        ->setData('data-3', 1234);

All data passed to the DataBuilder will be converted as ``string``.


Retrieving all datas

.. code:: php

    $dataBuilder->getData();


Retrieving a specific data

.. code:: php

    $dataBuilder->getData('data-1');


Delete all datas

.. code:: php

    $dataBuilder->removeData();


Delete a specific data

.. code:: php

    $dataBuilder->removeData('data-1');
