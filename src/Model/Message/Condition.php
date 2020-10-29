<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message;

use Closure;
use Kerox\Fcm\Helper\ValidatorTrait;

class Condition
{
    use ValidatorTrait;

    /**
     * @var string
     */
    private $preSeparator = '(';

    /**
     * @var string
     */
    private $postSeparator = ')';

    /**
     * @param mixed ...$topics
     */
    public function and(...$topics): string
    {
        $topics = $this->parseTopics($topics);

        return implode(' && ', $topics);
    }

    /**
     * @param mixed ...$topics
     */
    public function or(...$topics): string
    {
        $topics = $this->parseTopics($topics);

        return implode(' || ', $topics);
    }

    /**
     * @param mixed $topic
     */
    public function not($topic): string
    {
        if ($topic instanceof Closure) {
            $topic = $topic();
        } else {
            $this->isValidTopicName($topic);

            $topic = $this->formatTopic($topic);
        }

        return '!' . $this->preSeparator . $topic . $this->postSeparator;
    }

    private function parseTopics(array $topics): array
    {
        foreach ($topics as $key => $topic) {
            if (\is_string($topic)) {
                $this->isValidTopicName($topic);

                $topics[$key] = $this->formatTopic($topic);
            }

            if ($topic instanceof Closure) {
                $topics[$key] = $this->preSeparator . $topic() . $this->postSeparator;
            }
        }

        return $topics;
    }

    private function formatTopic(string $topic): string
    {
        return sprintf("'%s' in topics", $topic);
    }
}
