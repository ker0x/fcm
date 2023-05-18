<?php

declare(strict_types=1);

namespace Kerox\Fcm\Tests\Model;

use Kerox\Fcm\Model\Target\Condition;
use PHPUnit\Framework\TestCase;

class ConditionTest extends TestCase
{
    public function testConditionAndWithOnlyTopics(): void
    {
        $condition = Condition::and('TopicA', 'TopicB', 'TopicC');

        self::assertSame("'TopicA' in topics && 'TopicB' in topics && 'TopicC' in topics", (string) $condition);
    }

    public function testConditionOrWithOnlyTopics(): void
    {
        $condition = Condition::or('TopicA', 'TopicB', 'TopicC');

        self::assertSame("'TopicA' in topics || 'TopicB' in topics || 'TopicC' in topics", (string) $condition);
    }

    public function testConditionNotWithTopic(): void
    {
        $condition = Condition::not('TopicA');

        self::assertSame("!('TopicA' in topics)", (string) $condition);
    }

    public function testConditionAndWithClosure(): void
    {
        $condition = Condition::and('TopicA', fn () => Condition::or('TopicB', 'TopicC'));

        self::assertSame("'TopicA' in topics && ('TopicB' in topics || 'TopicC' in topics)", (string) $condition);
    }

    public function testConditionOrWithClosure(): void
    {
        $condition = Condition::or('TopicA', fn () => Condition::and('TopicB', 'TopicC'));

        self::assertSame("'TopicA' in topics || ('TopicB' in topics && 'TopicC' in topics)", (string) $condition);
    }

    public function testConditionNotWithClosure(): void
    {
        $condition = Condition::not(fn () => Condition::and('TopicA', 'TopicB'));

        self::assertSame("!('TopicA' in topics && 'TopicB' in topics)", (string) $condition);
    }

    public function testConditionWithMultipleClosure(): void
    {
        $condition = Condition::and('TopicA', fn () => Condition::or('TopicB', fn () => Condition::and('TopicC', 'TopicD', fn () => Condition::not('TopicE'))));

        self::assertSame("'TopicA' in topics && ('TopicB' in topics || ('TopicC' in topics && 'TopicD' in topics && (!('TopicE' in topics))))", (string) $condition);
    }
}
