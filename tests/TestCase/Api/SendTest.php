<?php

namespace Kerox\Fcm\Test\TestCase\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Kerox\Fcm\Api\Send;
use Kerox\Fcm\Model\Message;
use Kerox\Fcm\Test\TestCase\AbstractTestCase;

class SendTest extends AbstractTestCase
{
    public function testSendMessage()
    {
        $bodyResponse = file_get_contents(__DIR__ . '/../../Mocks/Response/Send/basic.json');
        $mockedResponse = new MockHandler([
            new Response(200, [], $bodyResponse),
        ]);

        $handler = HandlerStack::create($mockedResponse);
        $client = new Client([
            'handler' => $handler,
        ]);

        $sendApi = new Send('abcd1234', 'myproject-b5ae1', $client);

        $message = new Message('Breaking News');
        $message->setToken('4321dcba');

        $response = $sendApi->message($message, true);

        $this->assertEquals('projects/myproject-b5ae1/messages/0:1500415314455276%31bd1c9631bd1c96', $response->getName());
        $this->assertEquals('0:1500415314455276%31bd1c9631bd1c96', $response->getMessageId());
    }

    public function testSendMessageWithResponseError()
    {
        $bodyResponse = file_get_contents(__DIR__ . '/../../Mocks/Response/Send/error.json');
        $mockedResponse = new MockHandler([
            new Response(200, [], $bodyResponse),
        ]);

        $handler = HandlerStack::create($mockedResponse);
        $client = new Client([
            'handler' => $handler,
        ]);

        $sendApi = new Send('abcd1234', 'myproject-b5ae1', $client);

        $message = new Message('Breaking News');
        $message->setToken('4321dcba');

        $response = $sendApi->message($message, true);

        $this->assertNull($response->getName());
        $this->assertNull($response->getMessageId());
        $this->assertTrue($response->hasError());
        $this->assertEquals('UNSPECIFIED_ERROR', $response->getErrorCode());
        $this->assertEquals('No more information is available about this error.', $response->getErrorMessage());
    }
}
