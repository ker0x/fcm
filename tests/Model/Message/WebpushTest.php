<?php

declare(strict_types=1);

namespace Kerox\Fcm\Tests\Model\Message;

use Kerox\Fcm\Model\Message\Webpush;
use PHPUnit\Framework\Error\Warning;
use PHPUnit\Framework\TestCase;

class WebpushTest extends TestCase
{
    public function testDeprecationWarning(): void
    {
        $this->expectException(Warning::class);
        $this->expectExceptionMessage('Using array to set options is deprecated since version 2.1 and will be remove in version 3.0, use class "Kerox\Fcm\Model\Message\Options\WebpushOptions" instead.');

        (new Webpush())
            ->setOptions([
                'analytics_label' => 'webpush',
                'link' => 'https://example.com',
            ]);
    }
}
