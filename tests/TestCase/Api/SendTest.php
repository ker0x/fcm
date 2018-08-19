<?php

namespace Kerox\Fcm\Test\TestCase\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Kerox\Fcm\Api\Send;
use Kerox\Fcm\Model\Message;
use Kerox\Fcm\Model\Message\Android;
use Kerox\Fcm\Model\Message\Apns;
use Kerox\Fcm\Model\Message\Condition;
use Kerox\Fcm\Model\Message\Notification\AndroidNotification;
use Kerox\Fcm\Model\Message\Notification\ApnsNotification;
use Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert;
use Kerox\Fcm\Model\Message\Notification\WebpushNotification;
use Kerox\Fcm\Model\Message\Webpush;
use Kerox\Fcm\Model\Notification;
use Kerox\Fcm\Test\TestCase\AbstractTestCase;

class SendTest extends AbstractTestCase
{
    /**
     * @var \Kerox\Fcm\Api\Send
     */
    protected $sendApi;

    /**
     * @var string
     */
    protected $oauthToken;

    /**
     * @var string
     */
    protected $projectId;

    /**
     * @var string
     */
    protected $token;

    public function setUp()
    {
        $bodyResponse = file_get_contents(__DIR__ . '/../../Mocks/Response/Send/basic.json');
        $mockedResponse = new MockHandler([
            new Response(200, [], $bodyResponse),
        ]);

        $handler = HandlerStack::create($mockedResponse);
        $client = new Client([
            'handler' => $handler,
        ]);

        $this->sendApi = new Send('abcd1234', 'myproject-b5ae1', $client);
    }

    public function testSendMessage()
    {
        $message = new Message('Breaking News');
        $message->setToken('4321dcba');

        $response = $this->sendApi->message($message, true);

        $this->assertEquals('projects/myproject-b5ae1/messages/0:1500415314455276%31bd1c9631bd1c96', $response->getName());
        $this->assertEquals('0:1500415314455276%31bd1c9631bd1c96', $response->getMessageId());
    }
}
