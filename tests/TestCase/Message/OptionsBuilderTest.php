<?php

use Kerox\Fcm\Message\Exception\InvalidOptionsException;
use Kerox\Fcm\Message\OptionsBuilder;

class OptionsBuilderTest extends PHPUnit_Framework_TestCase
{
    public function testInvalidTimeToLive()
    {
        $this->expectException(InvalidOptionsException::class);
        $optionsBuilder = new OptionsBuilder();
        $optionsBuilder->setTimeToLive(2419201);
    }

    public function testInvalidPriority()
    {
        $this->expectException(InvalidOptionsException::class);
        $optionsBuilder = new OptionsBuilder();
        $optionsBuilder->setPriority('low');
    }
}