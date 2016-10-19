<?php
namespace Kerox\Fcm\Message;

use Kerox\Fcm\Message\Exception\InvalidTopicsException;

class Topics
{

    /**
     * @var array
     */
    protected $topics = [];

    /**
     * Topics constructor.
     *
     * @param \Kerox\Fcm\Message\TopicsBuilder $topicBuilder
     */
    public function __construct(TopicsBuilder $topicBuilder)
    {
        $this->topics = $topicBuilder->getTopics();
    }

    /**
     * Return topics as a string.
     *
     * @return array|string
     */
    public function toString()
    {
        if ($this->hasOnlyOneTopic()) {
            return '/topics/' . current($this->topics[0]);
        }

        return [
            'condition' => $this->buildCondition($this->topics)
        ];
    }

    /**
     * Check the number of topic.
     *
     * @return bool
     */
    public function hasOnlyOneTopic()
    {
        return count($this->topics) === 1;
    }

    /**
     * Build the condition.
     *
     * @param array $topics
     * @return string
     */
    private function buildCondition(array $topics): string
    {
        $condition = '';
        foreach ($topics as $topic) {
            $condition .= $this->parseForCondition($topic);
            $condition .= $this->parseForTopic($topic);
            $condition .= $this->parseForSubCondition($topic);
        }
        $this->checkCondition($condition);

        return $condition;
    }

    /**
     * Parse topic for condition.
     *
     * @param $topic
     * @return mixed
     */
    private function parseForCondition(array $topic): string
    {
        if (isset($topic['condition'])) {
            $parsedCondition = $topic['condition'];
        }

        return $parsedCondition ?? '';
    }

    /**
     * Parse topic for topic.
     *
     * @param $topic
     * @return string
     */
    private function parseForTopic(array $topic): string
    {
        if (isset($topic['topic'])) {
            $parsedTopic = "'{$topic['topic']}' in topics";
        }

        return $parsedTopic ?? '';
    }

    /**
     * Parse topic for sub condition.
     *
     * @param $topic
     * @return string|void
     */
    private function parseForSubCondition(array $topic): string
    {
        if (isset($topic['subCondition'])) {
            $parsedSubCondition = '(' . $this->buildCondition($topic['subCondition']) . ')';
        }

        return $parsedSubCondition ?? '';
    }

    /**
     * Check the number of conditions.
     *
     * @param string $condition
     * @return void
     * @throws \Kerox\Fcm\Message\Exception\InvalidTopicsException
     */
    private function checkCondition(string $condition)
    {
        preg_match_all('/&&|\|\|/', $condition, $matches);
        if (count(current($matches)) > 2) {
            throw InvalidTopicsException::tooManyConditions();
        }
    }
}
