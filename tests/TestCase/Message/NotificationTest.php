<?php
use Kerox\Fcm\Message\Exception\InvalidNotificationException;
use Kerox\Fcm\Message\Notification;
use Kerox\Fcm\Message\NotificationBuilder;

/**
 * Created by PhpStorm.
 * User: rmo
 * Date: 27/09/2016
 * Time: 01:02
 */
class NotificationTest extends PHPUnit_Framework_TestCase
{
    public function testNotificationFromNotificationBuilder()
    {
        $notificationBuilder = new NotificationBuilder('title');
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
            ->setBody('body');

        $notification = new Notification($notificationBuilder);
        $notification = $notification->build();

        $this->assertEquals([
            'title' => 'title',
            'body' => 'body',
            'sound' => 'sound',
            'badge' => 'badge',
            'icon' => 'icon',
            'tag' => 'tag',
            'color' => '#FFFFFF',
            'click_action' => 'click_action',
            'body_loc_key' => 'body_loc_key',
            'body_loc_args' => 'body_loc_args',
            'title_loc_key' => 'title_loc_key',
            'title_loc_args' => 'title_loc_args',
        ], $notification);
    }

    public function testNotificationFromArray()
    {
        $notification = new Notification([
            'title_loc_args' => 'title_loc_args',
            'title_loc_key' => 'title_loc_key',
            'body_loc_args' => 'body_loc_args',
            'body_loc_key' => 'body_loc_key',
            'click_action' => 'click_action',
            'color' => '#FFFFFF',
            'tag' => 'tag',
            'icon' => 'icon',
            'badge' => 'badge',
            'sound' => 'sound',
            'body' => 'body',
            'title' => 'title',
        ]);
        $notification = $notification->build();

        $this->assertEquals([
            'title' => 'title',
            'body' => 'body',
            'sound' => 'sound',
            'badge' => 'badge',
            'icon' => 'icon',
            'tag' => 'tag',
            'color' => '#FFFFFF',
            'click_action' => 'click_action',
            'body_loc_key' => 'body_loc_key',
            'body_loc_args' => 'body_loc_args',
            'title_loc_key' => 'title_loc_key',
            'title_loc_args' => 'title_loc_args',
        ], $notification);
    }

    public function testNotificationFromEmptyArray()
    {
        $this->expectException(InvalidNotificationException::class);
        new Notification([]);
    }

    public function testNotificationFromArrayWithoutTitle()
    {
        $this->expectException(InvalidNotificationException::class);
        new Notification(['body' => 'body']);
    }
}