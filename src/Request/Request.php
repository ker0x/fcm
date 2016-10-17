<?php
namespace Kerox\Fcm\Request;

use Kerox\Fcm\Message\Data;
use Kerox\Fcm\Message\Notification;
use Kerox\Fcm\Message\Options;
use Kerox\Fcm\Message\Topics;

class Request extends BaseRequest
{

    /**
     * @var string|array
     */
    protected $targets;

    /**
     * @var \Kerox\Fcm\Message\Notification
     */
    protected $notification;

    /**
     * @var \Kerox\Fcm\Message\Data
     */
    protected $data;

    /**
     * @var \Kerox\Fcm\Message\Options
     */
    protected $options;

    /**
     * @var
     */
    protected $topics;

    /**
     * Request constructor.
     *
     * @param string $apiKey
     * @param string|array $targets
     * @param \Kerox\Fcm\Message\Notification|null $notification
     * @param \Kerox\Fcm\Message\Data|null $data
     * @param \Kerox\Fcm\Message\Options|null $options
     * @param \Kerox\Fcm\Message\Topics $topics
     */
    public function __construct(
        string $apiKey,
        $targets,
        Notification $notification = null,
        Data $data = null,
        Options $options = null,
        Topics $topics = null
    ) {
        parent::__construct($apiKey);

        $this->targets = $targets;
        $this->notification = $notification;
        $this->data = $data;
        $this->options = $options;
        $this->topics = $topics;
    }

    /**
     * @return array
     */
    protected function buildBody(): array
    {
        $body = [
            'to' => $this->getTo(),
            'registration_ids' => $this->getRegistrationIds(),
            'notification' => $this->getNotification(),
            'data' => $this->getData(),
        ];
        $body += $this->getOptions();

        return array_filter($body);
    }

    /**
     * @return string|null
     */
    public function getTo()
    {
        $to = is_array($this->targets) ? null : $this->targets;
        if ($this->topics !== null && $this->topics->hasOnlyOneTopic()) {
            $to = $this->topics->toString();
        }

        return $to;
    }

    /**
     * @return array|null
     */
    protected function getRegistrationIds()
    {
        return is_array($this->targets) ? $this->targets : null;
    }

    /**
     * @return array
     */
    protected function getNotification(): array
    {
        $notification = $this->notification ? $this->notification->toArray() : null;

        return $notification;
    }

    /**
     * @return array
     */
    protected function getData(): array
    {
        $data = $this->data ? $this->data->toArray() : null;

        return $data;
    }

    /**
     * @return array
     */
    protected function getOptions(): array
    {
        $options = $this->options ? $this->options->toArray() : null;
        if ($this->topics !== null && !$this->topics->hasOnlyOneTopic()) {
            $options = array_merge($options, $this->topics->toString());
        }

        return $options;
    }
}
