<?php
use ker0x\Fcm\Fcm;
use ker0x\Fcm\Message\DataBuilder;
use ker0x\Fcm\Message\NotificationBuilder;
use ker0x\Fcm\Message\OptionsBuilder;

require_once '../vendor/autoload.php';

$apiKey = 'AIzaSyBmXaqLuv8EIyWsVRfzft_jQOdN8-j2nzQ';

$notificationBuilder = new NotificationBuilder('Hello World');
$notificationBuilder
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
    ->setTimeToLive(3600);

$fcm = new Fcm($apiKey);
$fcm->setNotification($notificationBuilder)
    ->setData($dataBuilder)
    ->setOptions($optionsBuilder);

$response = $fcm->sendTo('dhTJ-ujn2No:APA91bHhdfNzKE1oIDVd1hgAW4lAN_YEo_wUWx2dEkxWk80_dVhx8OAFaE2NrjC7ieFBJG5qTX84FGOYCPGHuAl6F7H2lGWrwZxIQTFMOa1zTMIBfNyI_ddroVSKql3R4-9lq271HcwC');

var_dump($response);