<?php
namespace ker0x\Fcm\Request;


use ker0x\Fcm\Message\Data;
use ker0x\Fcm\Message\Notification;
use ker0x\Fcm\Message\Options;
use ker0x\Fcm\Message\Targets;

class Request extends BaseRequest
{

    /**
     * @var string|array
     */
    protected $targets;

    /**
     * @var \ker0x\Fcm\Message\Notification
     */
    protected $notification;

    /**
     * @var \ker0x\Fcm\Message\Data
     */
    protected $data;

    /**
     * @var \ker0x\Fcm\Message\Options
     */
    protected $options;

    /**
     * Request constructor.
     *
     * @param string $apiKey
     * @param string|array $targets
     * @param \ker0x\Fcm\Message\Notification|null $notification
     * @param \ker0x\Fcm\Message\Data|null $data
     * @param \ker0x\Fcm\Message\Options|null $options
     */
    public function __construct($apiKey, $targets, Notification $notification = null, Data $data = null, Options $options = null)
    {
        parent::__construct($apiKey);

        $this->targets = $targets;
        $this->notification = $notification;
        $this->data = $data;
        $this->options = $options;
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
        return is_array($this->targets) ? null : $this->targets;
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
        $notification = $this->notification ? $this->notification->build() : null;

        return $notification;
    }

    /**
     * @return array
     */
    protected function getData(): array
    {
        $data = $this->data ? $this->data->build() : null;

        return $data;
    }

    /**
     * @return array
     */
    protected function getOptions(): array
    {
        $options = $this->options ? $this->options->build() : null;

        return $options;
    }
}