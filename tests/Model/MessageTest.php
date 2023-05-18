<?php

declare(strict_types=1);

namespace Kerox\Fcm\Tests\Model;

use Doctrine\Common\Annotations\AnnotationReader;
use Kerox\Fcm\Enum\AndroidMessagePriority;
use Kerox\Fcm\Enum\Direction;
use Kerox\Fcm\Enum\NotificationPriority;
use Kerox\Fcm\Enum\Permission;
use Kerox\Fcm\Enum\Visibility;
use Kerox\Fcm\Model\Config\AndroidConfig;
use Kerox\Fcm\Model\Config\ApnsConfig;
use Kerox\Fcm\Model\Config\WebpushConfig;
use Kerox\Fcm\Model\Message;
use Kerox\Fcm\Model\Notification\AndroidNotification;
use Kerox\Fcm\Model\Notification\AndroidNotification\Color;
use Kerox\Fcm\Model\Notification\AndroidNotification\LightSettings;
use Kerox\Fcm\Model\Notification\ApnsNotification;
use Kerox\Fcm\Model\Notification\ApnsNotification\Alert;
use Kerox\Fcm\Model\Notification\ApnsNotification\Sound;
use Kerox\Fcm\Model\Notification\Notification;
use Kerox\Fcm\Model\Notification\WebpushNotification;
use Kerox\Fcm\Model\Option\AndroidFcmOptions;
use Kerox\Fcm\Model\Option\ApnsFcmOptions;
use Kerox\Fcm\Model\Option\FcmOptions;
use Kerox\Fcm\Model\Option\WebpushFcmOptions;
use Kerox\Fcm\Model\Target\Condition;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\BackedEnumNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class MessageTest extends TestCase
{
    public function testMessage(): void
    {
        $message = new Message(
            notification: new Notification(
                title: 'Breaking News',
                body: 'New news story available.'
            ),
            target: Condition::and('TopicA', fn () => Condition::or('TopicB', 'TopicC')),
            data: [
                'story_id' => 'story_12345',
            ],
            android: new AndroidConfig(
                collapseKey: 'collapse_key',
                priority: AndroidMessagePriority::Normal,
                ttl: '3.000000001s',
                restrictedPackageName: 'fcm',
                data: [
                    'story_id' => 'story_12345',
                ],
                notification: new AndroidNotification(
                    title: 'New Breaking',
                    body: 'Check out the Top Story',
                    icon: 'icon',
                    color: '#FFFFFF',
                    sound: 'sound',
                    tag: 'tag',
                    clickAction: 'TOP_STORY_ACTIVITY',
                    titleLocKey: 'title_loc_key',
                    titleLocArgs: ['title_loc_args'],
                    bodyLocKey: 'body_loc_key',
                    bodyLocArgs: ['body_loc_args'],
                    channelId: '1234',
                    ticker: 'ticker',
                    sticky: true,
                    eventTime: '2022-10-12T19:00:00.012345678Z',
                    localOnly: true,
                    notificationPriority: NotificationPriority::High,
                    defaultSound: true,
                    defaultVibrateTimings: true,
                    defaultLightSettings: true,
                    vibrateTimings: [
                        '1.0s',
                        '1.5s',
                        '2.0s',
                        '2.5s',
                        '3.0s',
                        '3.5s',
                    ],
                    visibility: Visibility::Public,
                    notificationCount: 1,
                    lightSettings: new LightSettings(
                        color: new Color(0.1, 0.2, 0.3, 0.4),
                        lightOnDuration: '3.5s',
                        lightOffDuration: '3.5s'
                    ),
                    image: 'https://example.com/image.jpg',
                ),
                options: new AndroidFcmOptions('android'),
                directBootOk: true,
            ),
            webpush: new WebpushConfig(
                headers: [
                    'name' => 'wrench',
                    'mass' => '1.3kg',
                    'count' => '3',
                ],
                data: [
                    'name' => 'wrench',
                    'mass' => '1.3kg',
                    'count' => '3',
                ],
                notification: new WebpushNotification(
                    permission: Permission::Granted,
                    maxActions: 1,
                    actions: [
                        [
                            'title' => 'title',
                            'action' => 'action',
                            'icon' => 'icon',
                        ],
                    ],
                    badge: 'https://example.com/badge',
                    body: 'Check out the Top Story',
                    data: [
                        'name' => 'wrench',
                        'mass' => '1.3kg',
                        'count' => '3',
                    ],
                    direction: Direction::Ltr,
                    lang: 'fr-FR',
                    tag: 'tag',
                    icon: 'https://example.com/icon',
                    image: 'https://example.com/image',
                    renotify: true,
                    requireInteraction: true,
                    silent: true,
                    timestamp: (new \DateTime())->getTimestamp(),
                    title: 'New Breaking',
                    vibrate: [
                        300,
                        200,
                        300,
                    ],
                ),
                options: new WebpushFcmOptions(
                    analyticsLabel: 'webpush',
                    link: 'https://example.com',
                )
            ),
            apns: new ApnsConfig(
                headers: [
                    'name' => 'wrench',
                    'mass' => '1.3kg',
                    'count' => '3',
                ],
                payload: new ApnsNotification(
                    alert: new Alert(
                        title: 'Breaking News',
                        subtitle: 'Unbelievable',
                        body: 'Check out the Top Story',
                        launchImage: 'launch-image.jpg',
                        titleLocKey: 'title-loc-key',
                        titleLocArgs: [
                            'title-loc-args',
                        ],
                        subtitleLocKey: 'subtitle-loc-key',
                        subtitleLocArgs: [
                            'subtitle-loc-args',
                        ],
                        locKey: 'loc-key',
                        locArgs: [
                            'loc-args',
                        ],
                    ),
                    badge: 2,
                    sound: new Sound(
                        critical: 1, name: Sound::DEFAULT_NAME,
                        volume: 0.5,
                    ),
                    threadId: 'thread-id',
                    category: 'category',
                    contentAvailable: 1,
                    mutableContent: 1,
                    targetContentId: 'target-content-id',
                    interruptionLevel: 'interruption-level',
                    relevanceScore: 1,
                    filterCriteria: 'filter-criteria',
                    staleDate: 1,
                    contentState: 'content-state',
                    timestamp: (new \DateTime())->getTimestamp(),
                    events: 'events',
                ),
                options: new ApnsFcmOptions(
                    analyticsLabel: 'apns',
                    images: 'https://example.com/image.jpg',
                )
            ),
            options: new FcmOptions(
                'fcm',
            )
        );

        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $metadataAwareNameConverter = new MetadataAwareNameConverter($classMetadataFactory, new CamelCaseToSnakeCaseNameConverter());

        $serializer = new Serializer(
            [
                new BackedEnumNormalizer(),
                new ObjectNormalizer(null, $metadataAwareNameConverter),
            ],
            [new JsonEncoder()]
        );

        self::assertJsonStringEqualsJsonFile(__DIR__.'/../Mocks/Model/message.json', $serializer->serialize($message, 'json', [AbstractObjectNormalizer::SKIP_NULL_VALUES => true]);
    }

//    public function testMessageWithTopic(): void
//    {
//        $message = (new Message('Breaking News'))
//            ->setName('fcm')
//            ->setData([
//                'story_id' => 'story_12345',
//            ])
//            ->setTopic('TopicA');
//
//        self::assertJsonStringEqualsJsonFile(__DIR__.'/../Mocks/Model/message_with_topic.json', json_encode($message));
//    }
//
//    public function testInvalidMessage(): void
//    {
//        $this->expectException(\InvalidArgumentException::class);
//        $this->expectExceptionMessage('$message must be a string or an instance of "Kerox\Fcm\Model\Message\Notification".');
//
//        new Message(1234);
//    }
}
