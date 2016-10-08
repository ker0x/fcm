<?php
namespace Kerox\Fcm\Test\TestCase\Response;

use GuzzleHttp\Psr7\Response;
use Kerox\Fcm\Response\GroupResponse;
use Kerox\Fcm\Test\TestCase\AbstractTestCase;

class GroupResponseTest extends AbstractTestCase
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