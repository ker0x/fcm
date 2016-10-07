<?php
namespace ker0x\Fcm\Request;

class GroupRequest extends BaseRequest
{

    /**
     * @var string
     */
    protected $operation;

    /**
     * @var string
     */
    protected $notificationKeyName;

    /**
     * @var string
     */
    protected $notificationKey;

    /**
     * @var array
     */
    protected $registrationIds;

    /**
     * GroupRequest constructor.
     *
     * @param string $operation
     * @param string $notificationKeyName
     * @param string $notificationKey
     * @param array $registrationIds
     */
    public function __construct($operation, $notificationKeyName, $notificationKey, $registrationIds)
    {
        $this->operation = $operation;
        $this->notificationKeyName = $notificationKeyName;
        $this->notificationKey = $notificationKey;
        $this->registrationIds = $registrationIds;
    }

    /**
     * Build the body for the group request.
     *
     * @return array
     */
    protected function buildBody(): array
    {
        return [
            'operation' => $this->operation,
            'notification_key_name' => $this->notificationKeyName,
            'notification_key' => $this->notificationKey,
            'registration_ids' => $this->registrationIds,
        ];
    }
}