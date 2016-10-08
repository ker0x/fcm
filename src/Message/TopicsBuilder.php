<?php
namespace Kerox\Fcm\Message;

use Closure;

class TopicsBuilder
{
    protected $topic;

    protected $topics = [];

    public function __construct(string $topic)
    {
        $this->topics[] = compact('topic');
    }

    public function getAllTopic(): string
    {
        return array_column($this->topics, 'topic');
    }

    public function getTopics(): array
    {
        return $this->topics;
    }

    public function andTopic($topic)
    {
        $this->setCondition($topic, 'and');

        return $this;
    }

    public function orTopic($topic)
    {
        $this->setCondition($topic, 'or');

        return $this;
    }

    private function setCondition($topic, $condition)
    {
        $conditionBuilder = new ConditionsBuilder();
        $this->topics[] = $conditionBuilder->build($topic, $condition);

        return $this;
    }
}