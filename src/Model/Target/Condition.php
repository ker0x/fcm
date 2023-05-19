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

    public static function and(string|\Closure ...$topics): self
    {
        return new self(implode(' && ', self::parseTopics($topics)));
    }

    public static function or(string|\Closure ...$topics): self
    {
        return new self(implode(' || ', self::parseTopics($topics)));
    }

    public static function not(string|\Closure $topic): self
    {
        $topic = \is_callable($topic)
            ? $topic()
            : self::formatTopic($topic)
        ;

        return new self('!'.self::PRE_SEPARATOR.$topic.self::POST_SEPARATOR);
    }

    /**
     * @template TKey of array-key
     *
     * @param array<TKey, mixed> $topics
     *
     * @return array<TKey, mixed>
     */
    private static function parseTopics(array $topics): array
    {
        foreach ($topics as $key => $topic) {
            if (\is_string($topic)) {
                $topics[$key] = self::formatTopic($topic);

                continue;
            }

            $topics[$key] = self::PRE_SEPARATOR.$topic().self::POST_SEPARATOR;
        }

        return $topics;
    }

    private static function formatTopic(string $topic): string
    {
        return sprintf("'%s' in topics", $topic);
    }
}
