<?php

declare(strict_types=1);

namespace Kerox\Fcm\Test\TestCase\Model\Message;

use Kerox\Fcm\Model\Message\Webpush;
use Kerox\Fcm\Test\TestCase\AbstractTestCase;
use PHPUnit\Framework\Error\Warning;

class WebpushTest extends AbstractTestCase
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
