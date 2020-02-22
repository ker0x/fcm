<?php

declare(strict_types=1);

namespace Tests\Kerox\Fcm\Model;

use Kerox\Fcm\Model\Message;
use Kerox\Fcm\Model\Message\Android;
use Kerox\Fcm\Model\Message\Apns;
use Kerox\Fcm\Model\Message\Condition;
use Kerox\Fcm\Model\Message\Notification;
use Kerox\Fcm\Model\Message\Notification\AndroidNotification;
use Kerox\Fcm\Model\Message\Notification\AndroidNotification\Color;
use Kerox\Fcm\Model\Message\Notification\AndroidNotification\LightSettings;
use Kerox\Fcm\Model\Message\Notification\ApnsNotification;
use Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert;
use Kerox\Fcm\Model\Message\Notification\ApnsNotification\Sound;
use Kerox\Fcm\Model\Message\Notification\WebpushNotification;
use Kerox\Fcm\Model\Message\Options;
use Kerox\Fcm\Model\Message\Options\AndroidOptions;
use Kerox\Fcm\Model\Message\Options\ApnsOptions;
use Kerox\Fcm\Model\Message\Options\WebpushOptions;
use Kerox\Fcm\Model\Message\Webpush;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    public function testMessage(): void
    {
        $message = (new Message((new Notification('Breaking News'))->setBody('New news story available.')))
            ->setName('fcm')
            ->setData([
                'story_id' => 'story_12345',
            ])
            ->setAndroid(
                (new Android())
                    ->setCollapseKey('collapse_key')
                    ->setPriority(Android::PRIORITY_NORMAL)
                    ->setTtl('3.000000001s')
                    ->setRestrictedPackageName('fcm')
                    ->setData([
                        'story_id' => 'story_12345',
                    ])
                    ->setNotification(
                        (new AndroidNotification())
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
                            ->setChannelId('1234')
                            ->setTicker('ticker')
                            ->setSticky(true)
                            ->setEventTime('2019-10-12T19:00:00.012345678Z')
                            ->setLocalOnly(true)
                            ->setNotificationPriority(AndroidNotification::PRIORITY_HIGH)
                            ->setDefaultSound(true)
                            ->setDefaultVibrateTimings(true)
                            ->setDefaultLightSettings(true)
                            ->setVibrateTimings([
                                '1.0s',
                                '1.5s',
                                '2.0s',
                                '2.5s',
                                '3.0s',
                                '3.5s',
                            ])
                            ->setVisibility(AndroidNotification::VISIBILITY_PUBLIC)
                            ->setNotificationCount(1)
                            ->setLightSettings(
                                new LightSettings(
                                    new Color(0.1, 0.2, 0.3, 0.4),
                                    '3.5s',
                                    '3.5s'
                                )
                            )
                            ->setImage('https://example.com/image.jpg')
                    )
                    ->setOptions(
                        (new AndroidOptions())
                            ->setAnalyticsLabel('android')
                    )
            )
            ->setWebpush(
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
                            ->setActions([
                                'action 1',
                            ])
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
                            ->setVibrate([
                                300,
                                200,
                                300,
                            ])
                            ->setSticky(true)
                    )
                    ->setOptions(
                        (new WebpushOptions())
                            ->setAnalyticsLabel('webpush')
                            ->setLink('https://example.com')
                    )
            )
            ->setApns(
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
                                    ->setTitle('Breaking News')
                                    ->setBody('Check out the Top Story')
                                    ->setSubTitle('Unbelievable')
                                    ->setLaunchImage('launch-image.jpg')
                                    ->setTitleLocKey('title-loc-key')
                                    ->setTitleLocArgs([
                                        'title-loc-args',
                                    ])
                                    ->setSubTitleLocKey('subtitle-loc-key')
                                    ->setSubTitleLocArgs([
                                        'subtitle-loc-args',
                                    ])
                                    ->setLocKey('loc-key')
                                    ->setLocArgs([
                                        'loc-args',
                                    ])
                                    ->setActionLocKey('action-loc-key')
                            )
                            ->setBadge(true)
                            ->setSound(
                                (new Sound())
                                    ->isCritical()
                                    ->setName(Sound::DEFAULT_NAME)
                                    ->setVolume(0.5)
                            )
                            ->setContentAvailable(true)
                            ->isMutableContent()
                            ->setCategory('category')
                            ->setThreadId('thread-id')
                            ->setTargetContentId('target-content-id')
                    )
                    ->setOptions(
                        (new ApnsOptions())
                            ->setAnalyticsLabel('apns')
                            ->setImage('https://example.com/image.jpg')
                    )
            )
            ->setCondition((new Condition())->and('TopicA', static function () {
                return (new Condition())->or('TopicB', 'TopicC');
            }))
            ->setOptions(
                (new Options())
                    ->setAnalyticsLabel('fcm')
            )
        ;

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../Mocks/Model/message.json', json_encode($message));
    }

    public function testMessageWithTopic(): void
    {
        $message = (new Message('Breaking News'))
            ->setName('fcm')
            ->setData([
                'story_id' => 'story_12345',
            ])
            ->setTopic('TopicA')
        ;

        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/../Mocks/Model/message_with_topic.json', json_encode($message));
    }

    public function testInvalidMessage(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('$message must be a string or an instance of "Kerox\Fcm\Model\Message\Notification".');

        (new Message(1234));
    }
}
