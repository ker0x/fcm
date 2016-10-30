Options Builder
===============

Introduction
------------

You can build options for the notification by using the OptionsBuilder class.

Usage
-----

.. code:: php

    use Kerox\Message\OptionsBuilder;

    $optionsBuilder = new OptionsBuilder();
    $optionsBuilder
        ->setRestrictedPackageName('foo')
        ->setCollapseKey('Update available')
        ->setPriority('normal')
        ->setTimeToLive(3600)
        ->setContentAvailable(true)
        ->setDryRun(true);
