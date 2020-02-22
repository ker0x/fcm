<?php

declare(strict_types=1);

namespace Tests\Kerox\Fcm;

use Kerox\Fcm\Api\Send;
use Kerox\Fcm\Fcm;
use PHPUnit\Framework\TestCase;

class FcmTest extends TestCase
{
    /**
     * @var \Kerox\Fcm\Fcm
     */
    protected $fcm;

    public function setUp(): void
    {
        $this->fcm = new Fcm('4321dcba', 'abcd1234');
    }

    public function testGetInstanceOfApi(): void
    {
        $this->assertInstanceOf(Send::class, $this->fcm->send());
    }

    public function tearDown(): void
    {
        unset($this->fcm);
    }
}
