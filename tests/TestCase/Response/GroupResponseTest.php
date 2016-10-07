<?php

use GuzzleHttp\Psr7\Response;
use ker0x\Fcm\Response\GroupResponse;

class GroupResponseTest extends PHPUnit_Framework_TestCase
{
    public function testResponseWithMixedResults()
    {
        $notificationKey = 'notificationKey';
        $body = '{
            "success": 2,
            "failure": 2,
            "failed_registration_ids": [
                "target1",
                "target2",
                "target3"
            ]
        }';

        $response = new Response(200, [], $body);

        $groupResponse = new GroupResponse($response, $notificationKey);

        $this->assertEquals(2, $groupResponse->getNumberTargetsSuccess());
        $this->assertEquals(2, $groupResponse->getNumberTargetsFailure());
        $this->assertCount(3, $groupResponse->getTargetsFailed());
    }
}