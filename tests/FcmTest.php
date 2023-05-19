<?php

declare(strict_types=1);

namespace Kerox\Fcm\Tests;

use Kerox\Fcm\Api\Send;
use Kerox\Fcm\Fcm;
use PHPUnit\Framework\TestCase;

final class FcmTest extends TestCase
{
    private ?Fcm $fcm;

    protected function setUp(): void
    {
        $this->fcm = new Fcm('4321dcba', 'abcd1234');
    }

    protected function tearDown(): void
    {
        $this->fcm = null;
    }

    public function testItCanGetAnInstanceOfSendApi(): void
    {
        self::assertInstanceOf(Send::class, $this->fcm->send());
    }
}
