<?php
namespace Kerox\Fcm\Test\TestCase\Message;

use Kerox\Fcm\Message\Exception\InvalidTopicsException;
use Kerox\Fcm\Message\TopicsBuilder;
use Kerox\Fcm\Test\TestCase\AbstractTestCase;

class TopicsTest extends AbstractTestCase
{
    public function testTopicsFromTopicsBuilder()
    {
        $topicsBuilder = new TopicsBuilder('TopicA');

        $topic = $topicsBuilder->build();
        $topic = $topic->toString();

        $this->assertEquals('/topics/TopicA', $topic);
    }

    public function testTopicsWithOneCondition()
    {
        $topicsBuilder = new TopicsBuilder('TopicA');
        $topicsBuilder->andTopic('TopicB');

        $topic = $topicsBuilder->build();
        $topic = $topic->toString();

        $this->assertEquals([
            'condition' => "'TopicA' in topics && 'TopicB' in topics",
        ], $topic);
    }

    public function testTopicsWithTwoConditions()
    {
        $topicsBuilder = new TopicsBuilder('TopicA');
        $topicsBuilder->andTopic('TopicB')->orTopic('TopicC');

        $topic = $topicsBuilder->build();
        $topic = $topic->toString();

        $this->assertEquals([
            'condition' => "'TopicA' in topics && 'TopicB' in topics || 'TopicC' in topics",
        ], $topic);
    }

    public function testTopicsWithSubConditions()
    {
        $topicsBuilder = new TopicsBuilder('TopicA');
        $topicsBuilder->andTopic(function() {
            return (new TopicsBuilder('TopicB'))->orTopic('TopicC');
        });

        $topic = $topicsBuilder->build();
        $topic = $topic->toString();

        $this->assertEquals([
            'condition' => "'TopicA' in topics && ('TopicB' in topics || 'TopicC' in topics)",
        ], $topic);
    }

    public function testTopicWithTooManyConditions()
    {
        $this->expectException(InvalidTopicsException::class);
        $topicsBuilder = new TopicsBuilder('TopicA');
        $topicsBuilder
            ->orTopic('TopicB')
            ->andTopic(function() {
                return (new TopicsBuilder('TopicC'))->orTopic('TopicD');
            });

        $topic = $topicsBuilder->build();
        $topic = $topic->toString();
    }
}