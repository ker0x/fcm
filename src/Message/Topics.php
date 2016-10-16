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
     * @param \Kerox\Fcm\Message\TopicsBuilder $topicBuilder
     */
    public function __construct(TopicsBuilder $topicBuilder)
    {
        $this->topics = $topicBuilder->getTopics();
    }

    /**
     * @return array|string
     */
    public function toString()
    {
        if (count($this->topics) === 1) {
            return '/topics/' . current($this->topics[0]);
        }

        return [
            'condition' => $this->buildCondition($this->topics)
        ];
    }

    /**
     * @param array $topics
     * @return string
     */
    private function buildCondition(array $topics): string
    {
        $condition = '';
        foreach ($topics as $topic) {
            $condition = $this->parseTopic($topic, $condition);
        }
        $this->checkCondition($condition);

        return $condition;
    }

    /**
     * @param array $topic
     * @param string $condition
     * @return string
     */
    private function parseTopic(array $topic, string $condition): string
    {
        $keys = ['condition', 'topic', 'openParenthesis', 'topics', 'closeParenthesis'];

        foreach ($keys as $key) {
            if (isset($topic[$key])) {
                switch ($key) {
                    case 'topic':
                        $condition .= $this->formatTopic($topic[$key]);
                        break;

                    case 'topics':
                        $condition .= $this->buildCondition($topic[$key]);
                        break;

                    default:
                        $condition .= $topic[$key];
                        break;
                }
            }
        }

        return $condition;
    }

    /**
     *
     *
     * @param string $topic
     * @return string
     */
    private function formatTopic(string $topic): string
    {
        return "'{$topic}' in topics";
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
