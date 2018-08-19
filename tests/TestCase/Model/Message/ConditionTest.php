<?php

namespace Kerox\Fcm\Test\TestCase\Model\Message;

use Kerox\Fcm\Model\Message\Condition;
use Kerox\Fcm\Test\TestCase\AbstractTestCase;

class ConditionTest extends AbstractTestCase
{
    public function testConditionAndWithOnlyTopics()
    {
        $condition = (new Condition)->and('TopicA', 'TopicB', 'TopicC');

        $this->assertEquals("'TopicA' in topics && 'TopicB' in topics && 'TopicC' in topics", $condition);
    }

    public function testConditionOrWithOnlyTopics()
    {
        $condition = (new Condition)->or('TopicA', 'TopicB', 'TopicC');

        $this->assertEquals("'TopicA' in topics || 'TopicB' in topics || 'TopicC' in topics", $condition);
    }

    public function testConditionNotWithTopic()
    {
        $condition = (new Condition)->not('TopicA');

        $this->assertEquals("!('TopicA' in topics)", $condition);
    }

    public function testConditionAndWithClosure()
    {
        $condition = (new Condition)->and('TopicA', function () {
            return (new Condition)->or('TopicB', 'TopicC');
        });

        $this->assertEquals("'TopicA' in topics && ('TopicB' in topics || 'TopicC' in topics)", $condition);
    }

    public function testConditionOrWithClosure()
    {
        $condition = (new Condition)->or('TopicA', function () {
            return (new Condition)->and('TopicB', 'TopicC');
        });

        $this->assertEquals("'TopicA' in topics || ('TopicB' in topics && 'TopicC' in topics)", $condition);
    }

    public function testConditionNotWithClosure()
    {
        $condition = (new Condition)->not(function () {
            return (new Condition())->and('TopicA', 'TopicB');
        });

        $this->assertEquals("!('TopicA' in topics && 'TopicB' in topics)", $condition);
    }

    public function testConditionWithMultipleClosure()
    {
        $condition = (new Condition)->and('TopicA', function () {
            return (new Condition)->or('TopicB', function () {
                return (new Condition())->and('TopicC', 'TopicD', function () {
                   return (new Condition())->not('TopicE');
                });
            });
        });

        $this->assertEquals("'TopicA' in topics && ('TopicB' in topics || ('TopicC' in topics && 'TopicD' in topics && (!('TopicE' in topics))))", $condition);
    }

    public function testConditionAndWithInvalidTopics()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Topic A is an invalid topic name.');

        $condition = (new Condition)->and('Topic A', 'TopicB', 'TopicC');
    }
}
