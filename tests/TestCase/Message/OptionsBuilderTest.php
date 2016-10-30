<?php
namespace Kerox\Fcm\Test\TestCase\Message;

use Kerox\Fcm\Message\Exception\InvalidOptionsException;
use Kerox\Fcm\Message\OptionsBuilder;
use Kerox\Fcm\Test\TestCase\AbstractTestCase;

class OptionsBuilderTest extends AbstractTestCase
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