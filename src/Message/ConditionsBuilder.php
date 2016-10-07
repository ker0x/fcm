<?php
namespace ker0x\Fcm\Message;

use Closure;

class ConditionsBuilder
{

    private $replacement = [
        'and' => ' && ',
        'or' => ' || ',
    ];

    protected $conditions = [];

    public function build($topic, $condition)
    {
        if ($topic instanceof Closure) {
            return $this->expr($topic, $condition);
        }

        return compact('condition', 'topic');
    }


    public function expr(Closure $callback, $condition)
    {
        $conditions = new self();
        $callback($conditions);

        $topics = $conditions->conditions;

        return compact('condition', 'topics');
    }

    public function or_(array $topics)
    {
        $this->conditions[] = $this->build($topics, 'or');
    }

    public function and_(array $topics)
    {
        $this->conditions[] = $this->build($topics, 'and');
    }

    private function format(array $topics): array
    {
        foreach($topics as $key => $topic) {
            $topics[$key] = str_replace('{topic}', $topic, "'{topic}' in topics");
        }

        return $topics;
    }
}