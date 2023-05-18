<?php

declare(strict_types=1);

namespace Kerox\Fcm\Tests;

use Kerox\Fcm\Api\Send;
use Kerox\Fcm\Fcm;
use PHPUnit\Framework\TestCase;

class FcmTest extends TestCase
{
    /**
     * @var \Kerox\Fcm\Fcm
     */
    protected $fcm;

    protected function setUp(): void
    {
        $this->fcm = new Fcm('4321dcba', 'abcd1234');
    }

    public function testGetInstanceOfApi(): void
    {
        self::assertInstanceOf(Send::class, $this->fcm->send());
    }

    protected function tearDown(): void
    {
        unset($this->fcm);
    }
}
