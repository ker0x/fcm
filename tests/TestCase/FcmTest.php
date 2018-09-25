<?php

namespace Kerox\Fcm\Test\TestCase;

use Kerox\Fcm\Api\Send;
use Kerox\Fcm\Fcm;

class FcmTest extends AbstractTestCase
{
    /**
     * @var \Kerox\Fcm\Fcm
     */
    protected $fcm;

    public function setUp()
    {
        $this->fcm = new Fcm('4321dcba', 'abcd1234');
    }

    public function testGetInstanceOfApi(): void
    {
        $this->assertInstanceOf(Send::class, $this->fcm->send());
    }

    public function tearDown()
    {
        unset($this->fcm);
    }
}
