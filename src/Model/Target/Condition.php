<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Target;

final readonly class Condition implements \Stringable
{
    private const PRE_SEPARATOR = '(';
    private const POST_SEPARATOR = ')';

    private function __construct(private string $condition)
    {
    }

    public function __toString(): string
    {
        return $this->condition;
    }

    public static function and(string|callable ...$topics): self
    {
        return new self(implode(' && ', self::parseTopics($topics)));
    }

    public static function or(string|callable ...$topics): self
    {
        return new self(implode(' || ', self::parseTopics($topics)));
    }

    public static function not(string|callable $topic): self
    {
        $topic = \is_callable($topic)
            ? $topic()
            : self::formatTopic($topic)
        ;

        return new self('!'.self::PRE_SEPARATOR.$topic.self::POST_SEPARATOR);
    }

    /**
     * @param array<int, (callable(): mixed)|string> $topics
     *
     * @return string[]
     */
    private static function parseTopics(array $topics): array
    {
        foreach ($topics as $key => $topic) {
            if (\is_string($topic)) {
                $topics[$key] = self::formatTopic($topic);
            }

            if (\is_callable($topic)) {
                $topics[$key] = self::PRE_SEPARATOR.$topic().self::POST_SEPARATOR;
            }
        }

        return $topics;
    }

    private static function formatTopic(string $topic): string
    {
        return sprintf("'%s' in topics", $topic);
    }
}
