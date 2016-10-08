<?php
namespace Kerox\Fcm\Test\TestCase;

use Kerox\Fcm\Fcm;
use Kerox\Fcm\Message\DataBuilder;
use Kerox\Fcm\Message\NotificationBuilder;
use Kerox\Fcm\Message\OptionsBuilder;
use Kerox\Fcm\Test\TestCase\AbstractTestCase;

class FcmTest extends AbstractTestCase
{
    public $target;
    public $api_key;

    public function setUp()
    {
        $this->api_key = getenv('API_KEY');
        $this->target = getenv('TARGET');
    }

    public function testFcm()
    {
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
            ->addData('data-1', 'data-1')
            ->addData('data-2', true)
            ->addData('data-3', 1234);

        $optionsBuilder = new OptionsBuilder();
        $optionsBuilder
            ->setCollapseKey('Update available')
            ->setPriority('normal')
            ->setTimeToLive(3600)
            ->setContentAvailable(true)
            ->setDryRun(true);

        $fcm = new Fcm($this->api_key);
        $fcm->setNotification($notificationBuilder)
            ->setData($dataBuilder)
            ->setOptions($optionsBuilder);

        $response = $fcm->sendTo($this->target);

        $this->assertEquals(1, $response->getNumberTargetsSuccess());
        $this->assertEquals(0, $response->getNumberTargetsFailure());
        $this->assertEquals(0, $response->getNumberTargetsModify());
    }

    public function tearDown()
    {
        unset($this->target, $this->api_key);
    }
}