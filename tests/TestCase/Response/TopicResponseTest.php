<?php

use GuzzleHttp\Psr7\Response;
use Kerox\Fcm\Message\TopicsBuilder;
use Kerox\Fcm\Response\TopicResponse;

class TopicResponseTest extends PHPUnit_Framework_TestCase
{
    public function testResponseWithSuccess()
    {
        $topic = new TopicsBuilder('topic_test');
        $body = '{"message_id":"1234"}';

        $response = new Response(200, [], $body);

        $topicResponse = new TopicResponse($response, $topic);

        $this->assertTrue($topicResponse->isSuccess());
        $this->assertFalse($topicResponse->shouldRetry());
        $this->assertNull($topicResponse->getError());
    }

    public function testResponseWithError()
    {
        $topic = new TopicsBuilder('topic_test');
        $body = '{"error":"MessageTooBig"}';

        $response = new Response(200, [], $body);

        $topicResponse = new TopicResponse($response, $topic);

        $this->assertFalse($topicResponse->isSuccess());
        $this->assertFalse($topicResponse->shouldRetry());
        $this->assertEquals("MessageTooBig", $topicResponse->getError());
    }

    public function testResponseWithErrorAndShouldRetry()
    {
        $topic = new TopicsBuilder('topic_test');
        $body = '{"error":"TopicsMessageRateExceeded"}';

        $response = new Response(200, [], $body);

        $topicResponse = new TopicResponse($response, $topic);

        $this->assertFalse($topicResponse->isSuccess());
        $this->assertTrue($topicResponse->shouldRetry());
        $this->assertEquals("TopicsMessageRateExceeded", $topicResponse->getError());
    }
}