<?php

namespace Kerox\Fcm\Test\TestCase\Model\Message;

use Kerox\Fcm\Model\Message\Condition;
use Kerox\Fcm\Test\TestCase\AbstractTestCase;

class ConditionTest extends AbstractTestCase
{
    public function testConditionAndWithOnlyTopics(): void
    {
        $condition = (new Condition)->and('TopicA', 'TopicB', 'TopicC');

        $this->assertEquals("'TopicA' in topics && 'TopicB' in topics && 'TopicC' in topics", $condition);
    }

    public function testConditionOrWithOnlyTopics(): void
    {
        $condition = (new Condition)->or('TopicA', 'TopicB', 'TopicC');

        $this->assertEquals("'TopicA' in topics || 'TopicB' in topics || 'TopicC' in topics", $condition);
    }

    public function testConditionNotWithTopic(): void
    {
        $condition = (new Condition)->not('TopicA');

        $this->assertEquals("!('TopicA' in topics)", $condition);
    }

    public function testConditionAndWithClosure(): void
    {
        $condition = (new Condition)->and('TopicA', static function () {
            return (new Condition)->or('TopicB', 'TopicC');
        });

        $this->assertEquals("'TopicA' in topics && ('TopicB' in topics || 'TopicC' in topics)", $condition);
    }

    public function testConditionOrWithClosure(): void
    {
        $condition = (new Condition)->or('TopicA', static function () {
            return (new Condition)->and('TopicB', 'TopicC');
        });

        $this->assertEquals("'TopicA' in topics || ('TopicB' in topics && 'TopicC' in topics)", $condition);
    }

    public function testConditionNotWithClosure(): void
    {
        $condition = (new Condition)->not(static function () {
            return (new Condition())->and('TopicA', 'TopicB');
        });

        $this->assertEquals("!('TopicA' in topics && 'TopicB' in topics)", $condition);
    }

    public function testConditionWithMultipleClosure(): void
    {
        $condition = (new Condition)->and('TopicA', static function () {
            return (new Condition)->or('TopicB', static function () {
                return (new Condition())->and('TopicC', 'TopicD', static function () {
                   return (new Condition())->not('TopicE');
                });
            });
        });

        $this->assertEquals("'TopicA' in topics && ('TopicB' in topics || ('TopicC' in topics && 'TopicD' in topics && (!('TopicE' in topics))))", $condition);
    }

    public function testConditionAndWithInvalidTopics(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Topic A is an invalid topic name.');

        (new Condition)->and('Topic A', 'TopicB', 'TopicC');
    }
}
