<?php
namespace Kerox\Fcm\Test\TestCase\Response;

use GuzzleHttp\Psr7\Response;
use Kerox\Fcm\Response\DownstreamResponse;
use Kerox\Fcm\Response\Exception\InvalidRequestException;
use Kerox\Fcm\Response\Exception\ServerResponseException;
use Kerox\Fcm\Response\Exception\UnauthorizedRequestException;
use Kerox\Fcm\Test\TestCase\AbstractTestCase;

class DownstreamResponseTest extends AbstractTestCase
{
    public $tokens;

    public function setUp()
    {
        $this->tokens = [
            'first_token',
            'second_token',
            'third_token',
        ];
    }

    public function testResponseWithMixedResults()
    {
        $tokens = [
            'token_1',
            'token_2',
            'token_3',
            'token_4',
            'token_5',
            'token_6',
            'token_7',
            'token_8',
            'token_9',
            'token_10',
            'token_11',
            'token_12',
            'token_13',
        ];
        $body = '{
            "multicast_id": 108,
            "success": 3,
            "failure": 7,
            "canonical_ids": 3,
            "results": [
                {"message_id": "1:01"},
                {"error": "NotRegistered"},
                {"message_id": "1:03", "registration_id": "123"},
                {"error": "DeviceMessageRateExceeded"},
                {"message_id": "1:05"},
                {"error": "InvalidRegistration"},
                {"message_id": "1:07", "registration_id": "213"},
				{"error": "InternalServerError"},
                {"message_id": "1:09"},
                {"error": "MissingRegistration"},
                {"message_id": "1:11", "registration_id": "321"},
				{"error": "Unavailable"},
				{"error": "MessageTooBig"}
            ]
        }';

        $response = new Response(200, [], $body);

        $downstreamResponse = new DownstreamResponse($response, $tokens);

        $this->assertEquals(3, $downstreamResponse->getNumberSuccess());
        $this->assertEquals(7, $downstreamResponse->getNumberFailure());
        $this->assertEquals(3, $downstreamResponse->getNumberModify());

        $this->assertCount(2, $downstreamResponse->getTargetsToDelete());
        $this->assertCount(3, $downstreamResponse->getTargetsToModify());
        $this->assertCount(3, $downstreamResponse->getTargetsToRetry());
        $this->assertCount(2, $downstreamResponse->getTargetsWithError());

        $this->assertEquals([
            'token_2',
            'token_6',
        ], $downstreamResponse->getTargetsToDelete());
        $this->assertEquals([
            'token_3' => '123',
            'token_7' => '213',
            'token_11' => '321',
        ], $downstreamResponse->getTargetsToModify());
        $this->assertEquals([
            'token_10' => 'MissingRegistration',
            'token_13' => 'MessageTooBig',
        ], $downstreamResponse->getTargetsWithError());
    }

    public function testInvalidRequest()
    {
        $this->expectException(InvalidRequestException::class);
        $response = new Response(400);

        new DownstreamResponse($response, $this->tokens);
    }

    public function testUnauthorizedRequest()
    {
        $this->expectException(UnauthorizedRequestException::class);
        $response = new Response(401);

        new DownstreamResponse($response, $this->tokens);
    }

    public function testServerResponse()
    {
        $this->expectException(ServerResponseException::class);
        $response = new Response(500);

        new DownstreamResponse($response, $this->tokens);
    }

    public function tearDown()
    {
        unset($this->tokens);
    }
}