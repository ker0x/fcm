<?php
namespace Kerox\Fcm\Test\TestCase;

use Kerox\Fcm\FcmGroup;

class FcmGroupTest extends AbstractTestCase
{
    public $target;
    public $api_key;

    public function setUp()
    {
        $this->api_key = getenv('API_KEY');
        $this->target = getenv('TARGET');
    }

    public function testCreateFcmGroup()
    {
        $fcmGroup = new FcmGroup($this->api_key);
        $fcmGroup->createGroup('Test', $this->target);
    }

    public function tearDown()
    {
        unset($this->target, $this->api_key);
    }
}