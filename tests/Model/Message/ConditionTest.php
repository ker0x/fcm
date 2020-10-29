<?php

declare(strict_types=1);

namespace Kerox\Fcm\Tests\Model\Message;

use Kerox\Fcm\Model\Message\Condition;
use PHPUnit\Framework\TestCase;

class ConditionTest extends TestCase
{
    public function testConditionAndWithOnlyTopics(): void
    {
        $condition = (new Condition())->and('TopicA', 'TopicB', 'TopicC');

        self::assertSame("'TopicA' in topics && 'TopicB' in topics && 'TopicC' in topics", $condition);
    }

    public function testConditionOrWithOnlyTopics(): void
    {
        $condition = (new Condition())->or('TopicA', 'TopicB', 'TopicC');

        self::assertSame("'TopicA' in topics || 'TopicB' in topics || 'TopicC' in topics", $condition);
    }

    public function testConditionNotWithTopic(): void
    {
        $condition = (new Condition())->not('TopicA');

        self::assertSame("!('TopicA' in topics)", $condition);
    }

    public function testConditionAndWithClosure(): void
    {
        $condition = (new Condition())->and('TopicA', static function () {
            return (new Condition())->or('TopicB', 'TopicC');
        });

        self::assertSame("'TopicA' in topics && ('TopicB' in topics || 'TopicC' in topics)", $condition);
    }

    public function testConditionOrWithClosure(): void
    {
        $condition = (new Condition())->or('TopicA', static function () {
            return (new Condition())->and('TopicB', 'TopicC');
        });

        self::assertSame("'TopicA' in topics || ('TopicB' in topics && 'TopicC' in topics)", $condition);
    }

    public function testConditionNotWithClosure(): void
    {
        $condition = (new Condition())->not(static function () {
            return (new Condition())->and('TopicA', 'TopicB');
        });

        self::assertSame("!('TopicA' in topics && 'TopicB' in topics)", $condition);
    }

    public function testConditionWithMultipleClosure(): void
    {
        $condition = (new Condition())->and('TopicA', static function () {
            return (new Condition())->or('TopicB', static function () {
                return (new Condition())->and('TopicC', 'TopicD', static function () {
                    return (new Condition())->not('TopicE');
                });
            });
        });

        self::assertSame("'TopicA' in topics && ('TopicB' in topics || ('TopicC' in topics && 'TopicD' in topics && (!('TopicE' in topics))))", $condition);
    }

    public function testConditionAndWithInvalidTopics(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('"Topic A" is an invalid topic name.');

        (new Condition())->and('Topic A', 'TopicB', 'TopicC');
    }
}
