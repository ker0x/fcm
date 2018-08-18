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
        $this->oauthToken = getenv('OAUTH_TOKEN');
        $this->projectId = getenv('PROJECT_ID');
        $this->token = getenv('TOKEN');

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
        $message = $this->getMessage();

        $response = $this->sendApi->message($message, true);
    }

    private function getMessage()
    {
        $notification = (new Notification('Breaking News'))->setBody('New news story available.');

        $message = new Message($notification);
        $message->setData(['story_id' => 'story_12345']);
        $message->setAndroid(
            (new Android())
                ->setCollapseKey('collapse_key')
                ->setPriority(Android::PRIORITY_NORMAL)
                ->setTtl('3.000000001s')
                ->setRestrictedPackageName('fcm')
                ->setData(['story_id' => 'story_12345'])
                ->setNotification(
                    (new AndroidNotification)
                        ->setTitle('New Breaking')
                        ->setBody('Check out the Top Story')
                        ->setIcon('icon')
                        ->setColor('#FFFFFF')
                        ->setSound('sound')
                        ->setTag('tag')
                        ->setClickAction('TOP_STORY_ACTIVITY')
                        ->setBodyLocKey('body_loc_key')
                        ->setBodyLocArgs('body_loc_args')
                        ->setTitleLocKey('title_loc_key')
                        ->setTitleLocArgs('title_loc_args')
                )
        );
        $message->setWebpush(
            (new Webpush())
                ->setHeaders([
                    'name' => 'wrench',
                    'mass' => '1.3kg',
                    'count' => '3',
                ])
                ->setData([
                    'name' => 'wrench',
                    'mass' => '1.3kg',
                    'count' => '3',
                ])
                ->setNotification(
                    (new WebpushNotification())
                        ->setTitle('New Breaking')
                        ->setBody('Check out the Top Story')
                        ->setPermission(WebpushNotification::PERMISSION_GRANTED)
                        ->setActions(['action 1'])
                        ->setBadge('https://example.com/badge')
                        ->setData([
                            'name' => 'wrench',
                            'mass' => '1.3kg',
                            'count' => '3',
                        ])
                        ->setDir(WebpushNotification::DIR_LTR)
                        ->setLang('fr-FR')
                        ->setTag('tag')
                        ->setIcon('https://example.com/icon')
                        ->setImage('https://example.com/image')
                        ->setRenotify(false)
                        ->setRequireInteraction(false)
                        ->setSilent(true)
                        ->setTimestamp(new \DateTime())
                        ->setVibrate([200, 300, 200])
                        ->setSticky(true)
                )
                ->setFcmOptions([
                    'link' => 'https://example.com'
                ])
        );
        $message->setApns(
            (new Apns())
                ->setHeaders([
                    'name' => 'wrench',
                    'mass' => '1.3kg',
                    'count' => '3',
                ])
                ->setPayload(
                    (new ApnsNotification())
                        ->setAlert(
                            (new Alert())
                                ->setTitle('New Breaking')
                                ->setBody('Check out the Top Story')
                                ->setTitleLocKey('title-loc-key')
                                ->setTitleLocArgs(['title-loc-args'])
                                ->setActionLocKey('action-loc-key')
                                ->setLocKey('loc-key')
                                ->setLocArgs(['loc-key'])
                                ->setLaunchImage('launch-image.jpg')
                        )
                        ->setBadge(true)
                        ->setSound('sound')
                        ->setContentAvailable(true)
                        ->setCategory('category')
                        ->setThreadId('thread-id')
                )
        );
        $message->setCondition((new Condition)->and('Topic A', function () {
            return (new Condition)->or('Topic B', 'Topic C');
        }));
    }
}
