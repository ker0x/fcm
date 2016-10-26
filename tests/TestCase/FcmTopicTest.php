<?php
namespace Kerox\Fcm\Test\TestCase;

use Kerox\Fcm\Fcm;
use Kerox\Fcm\Message\DataBuilder;
use Kerox\Fcm\Message\NotificationBuilder;
use Kerox\Fcm\Message\OptionsBuilder;
use Kerox\Fcm\Message\TopicsBuilder;

class FcmTopicTest extends AbstractTestCase
{
    protected $target;
    protected $api_key;
    protected $notification;
    protected $data;
    protected $options;

    public function setUp()
    {
        $this->api_key = getenv('API_KEY');
        $this->target = getenv('TARGET');

        $notificationBuilder = new NotificationBuilder('Hello World');
        $notificationBuilder
            ->setTitleLocArgs('title_loc_args')
            ->setTitleLocKey('title_loc_key')
            ->setBodyLocArgs('body_loc_args')
            ->setBodyLocKey('body_loc_key')
            ->setClickAction('click_action')
            ->setColor('#FFFFFF')
            ->setTag('tag')
            ->setIcon('icon')
            ->setBadge('badge')
            ->setSound('sound')
            ->setBody('My awesome Hello World');

        $dataBuilder = new DataBuilder();
        $dataBuilder
            ->setData('data-1', 'data-1')
            ->setData('data-2', true)
            ->setData('data-3', 1234);

        $optionsBuilder = new OptionsBuilder();
        $optionsBuilder
            ->setCollapseKey('Update available')
            ->setPriority('normal')
            ->setTimeToLive(3600)
            ->setContentAvailable(true)
            ->setDryRun(true);

        $this->notification = $notificationBuilder->build();
        $this->data = $dataBuilder->build();
        $this->options = $optionsBuilder->build();
    }

    public function testFcmSendToTopic()
    {
        $topicBuilder = new TopicsBuilder('myTopic');
        $topic = $topicBuilder->build();

        $fcm = new Fcm($this->api_key);
        $fcm->setNotification($this->notification)
            ->setData($this->data)
            ->setOptions($this->options);

        $response = $fcm->sendToTopic($topic);

        $this->assertTrue($response->isSuccess());
        $this->assertFalse($response->shouldRetry());
        $this->assertNull($response->getError());
    }

    public function testFcmSendToManyTopics()
    {
        $topicBuilder = new TopicsBuilder('myTopic');
        $topicBuilder->andTopic(function () {
            return (new TopicsBuilder('yourTopic'))->orTopic('theirTopic');
        });
        $topic = $topicBuilder->build();

        $fcm = new Fcm($this->api_key);
        $fcm->setNotification($this->notification)
            ->setData($this->data)
            ->setOptions($this->options);

        $response = $fcm->sendToTopic($topic);

        $this->assertTrue($response->isSuccess());
        $this->assertFalse($response->shouldRetry());
        $this->assertNull($response->getError());
    }

    public function tearDown()
    {
        unset($this->target, $this->api_key);
    }
}