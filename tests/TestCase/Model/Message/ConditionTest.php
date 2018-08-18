<?php

namespace Kerox\Fcm\Test\TestCase\Model\Message;

use Kerox\Fcm\Model\Message\Condition;
use Kerox\Fcm\Test\TestCase\AbstractTestCase;

class ConditionTest extends AbstractTestCase
{
    public function testConditionAndWithOnlyTopics()
    {
        $condition = (new Condition)->and('Topic A', 'Topic B', 'Topic C');

        $this->assertEquals("'Topic A' in topics && 'Topic B' in topics && 'Topic C' in topics", $condition);
    }

    public function testConditionOrWithOnlyTopics()
    {
        $condition = (new Condition)->or('Topic A', 'Topic B', 'Topic C');

        $this->assertEquals("'Topic A' in topics || 'Topic B' in topics || 'Topic C' in topics", $condition);
    }

    public function testConditionNotWithTopic()
    {
        $condition = (new Condition)->not('Topic A');

        $this->assertEquals("!('Topic A' in topics)", $condition);
    }

    public function testConditionAndWithClosure()
    {
        $condition = (new Condition)->and('Topic A', function () {
            return (new Condition)->or('Topic B', 'Topic C');
        });

        $this->assertEquals("'Topic A' in topics && ('Topic B' in topics || 'Topic C' in topics)", $condition);
    }

    public function testConditionOrWithClosure()
    {
        $condition = (new Condition)->or('Topic A', function () {
            return (new Condition)->and('Topic B', 'Topic C');
        });

        $this->assertEquals("'Topic A' in topics || ('Topic B' in topics && 'Topic C' in topics)", $condition);
    }

    public function testConditionNotWithClosure()
    {
        $condition = (new Condition)->not(function () {
            return (new Condition())->and('Topic A', 'Topic B');
        });

        $this->assertEquals("!('Topic A' in topics && 'Topic B' in topics)", $condition);
    }

    public function testConditionWithMultipleClosure()
    {
        $condition = (new Condition)->and('Topic A', function () {
            return (new Condition)->or('Topic B', function () {
                return (new Condition())->and('Topic C', 'Topic D', function () {
                   return (new Condition())->not('Topic E');
                });
            });
        });

        $this->assertEquals("'Topic A' in topics && ('Topic B' in topics || ('Topic C' in topics && 'Topic D' in topics && (!('Topic E' in topics))))", $condition);
    }
}
