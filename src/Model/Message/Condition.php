<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message;

use Closure;
use Kerox\Fcm\Helper\ValidatorTrait;

/**
 * Class Condition.
 */
class Condition
{
    use ValidatorTrait;

    /**
     * @var string
     */
    protected $preSeparator = '(';

    /**
     * @var string
     */
    protected $postSeparator = ')';

    /**
     * @param mixed ...$topics
     *
     * @return string
     */
    public function and(...$topics): string
    {
        $topics = $this->parseTopics($topics);

        return implode(' && ', $topics);
    }

    /**
     * @param mixed ...$topics
     *
     * @return string
     */
    public function or(...$topics): string
    {
        $topics = $this->parseTopics($topics);

        return implode(' || ', $topics);
    }

    /**
     * @param mixed $topic
     *
     * @return string
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

    /**
     * @param array $topics
     *
     * @return array
     */
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

    /**
     * @param string $topic
     *
     * @return string
     */
    private function formatTopic(string $topic): string
    {
        return sprintf("'%s' in topics", $topic);
    }
}
