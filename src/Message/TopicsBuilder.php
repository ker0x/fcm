<?php
namespace Kerox\Fcm\Message;

use Closure;

/**
 * Class TopicsBuilder
 * @package Kerox\Fcm\Message
 */
class TopicsBuilder
{

    /**
     * @var array
     */
    protected $topics = [];

    /**
     * TopicsBuilder constructor.
     * @param string $topic
     */
    public function __construct(string $topic)
    {
        $this->topics[] = compact('topic');
    }

    /**
     * @return array
     */
    public function getTopics(): array
    {
        return $this->topics;
    }

    /**
     * @param $topic
     * @return \Kerox\Fcm\Message\TopicsBuilder
     */
    public function andTopic($topic): TopicsBuilder
    {
        return $this->setCondition($topic, ' && ');
    }

    /**
     * @param $topic
     * @return \Kerox\Fcm\Message\TopicsBuilder
     */
    public function orTopic($topic): TopicsBuilder
    {
        return $this->setCondition($topic, ' || ');
    }

    /**
     * @param $topic
     * @param string $condition
     * @return \Kerox\Fcm\Message\TopicsBuilder
     */
    private function setCondition($topic, string $condition): TopicsBuilder
    {
        if ($topic instanceof Closure) {
            return $this->setSubCondition($topic, $condition);
        }
        $this->topics[] = compact('condition', 'topic');

        return $this;
    }

    /**
     * @param \Closure $callback
     * @param string $condition
     * @return \Kerox\Fcm\Message\TopicsBuilder
     */
    private function setSubCondition(Closure $callback, string $condition): TopicsBuilder
    {
        $subCondition = $callback()->getTopics();
        $this->topics[] = compact('condition', 'subCondition');

        return $this;
    }

    /**
     * @return \Kerox\Fcm\Message\Topics
     */
    public function build(): Topics
    {
        return new Topics($this);
    }
}
