<?php

namespace Kerox\Fcm\Test\TestCase\Model;

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

class MessageTest extends AbstractTestCase
{
    public function testMessage()
    {
        $expectedJson = file_get_contents(__DIR__ . '/../../Mocks/Model/message.json');

        $message = (new Message((new Notification('Breaking News'))->setBody('New news story available.')))
            ->setData(['story_id' => 'story_12345'])
            ->setAndroid(
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
            )->setWebpush(
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
                            ->setRenotify(true)
                            ->setRequireInteraction(true)
                            ->setSilent(true)
                            ->setTimestamp(new \DateTime('2018-08-16 00:00:00'))
                            ->setVibrate([300, 200, 300])
                            ->setSticky(true)
                    )
                    ->setFcmOptions([
                        'link' => 'https://example.com',
                    ])
            )->setApns(
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
                                    ->setLocArgs(['loc-args'])
                                    ->setLaunchImage('launch-image.jpg')
                            )
                            ->setBadge(true)
                            ->setSound('sound')
                            ->setContentAvailable(true)
                            ->setCategory('category')
                            ->setThreadId('thread-id')
                    )
            )->setCondition((new Condition)->and('TopicA', function () {
                return (new Condition)->or('TopicB', 'TopicC');
            }));

        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($message));
    }
}
