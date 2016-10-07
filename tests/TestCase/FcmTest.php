<?php

use ker0x\Fcm\Fcm;
use ker0x\Fcm\Message\DataBuilder;
use ker0x\Fcm\Message\NotificationBuilder;
use ker0x\Fcm\Message\OptionsBuilder;

class FcmTest extends PHPUnit_Framework_TestCase
{
    public $target;
    public $api_key;

    public function setUp()
    {
        $this->api_key = getenv('FCM_API_KEY');
        $this->target = getenv('TOKEN');
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

        $fcm = new Fcm('AIzaSyBmXaqLuv8EIyWsVRfzft_jQOdN8-j2nzQ');
        $fcm->setNotification($notificationBuilder)
            ->setData($dataBuilder)
            ->setOptions($optionsBuilder);

        $response = $fcm->sendTo('dhTJ-ujn2No:APA91bHhdfNzKE1oIDVd1hgAW4lAN_YEo_wUWx2dEkxWk80_dVhx8OAFaE2NrjC7ieFBJG5qTX84FGOYCPGHuAl6F7H2lGWrwZxIQTFMOa1zTMIBfNyI_ddroVSKql3R4-9lq271HcwC');

        $this->assertEquals(1, $response->getNumberTargetsSuccess());
        $this->assertEquals(0, $response->getNumberTargetsFailure());
        $this->assertEquals(0, $response->getNumberTargetsModify());
    }

    public function tearDown()
    {
        unset($this->target, $this->api_key);
    }
}