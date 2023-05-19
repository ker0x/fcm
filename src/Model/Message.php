<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model;

use Kerox\Fcm\Model\Config\AndroidConfig;
use Kerox\Fcm\Model\Config\ApnsConfig;
use Kerox\Fcm\Model\Config\WebpushConfig;
use Kerox\Fcm\Model\Notification\Notification;
use Kerox\Fcm\Model\Option\FcmOptions;
use Kerox\Fcm\Model\Target\Condition;
use Kerox\Fcm\Model\Target\Token;
use Kerox\Fcm\Model\Target\Topic;

/**
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#resource:-message
 */
final readonly class Message
{
    public Notification $notification;
    public ?string $token;
    public ?string $topic;
    public ?string $condition;

    /**
     * @param array<string, string> $data
     */
    public function __construct(
        Notification|string $notification,
        Token|Topic|Condition $target,
        public array $data = [],
        public ?AndroidConfig $android = null,
        public ?WebpushConfig $webpush = null,
        public ?ApnsConfig $apns = null,
        public ?FcmOptions $options = null,
    ) {
        $this->notification = \is_string($notification)
            ? new Notification($notification)
            : $notification
        ;

        match (true) {
            $target instanceof Token => $this->token = $target->__toString(),
            $target instanceof Topic => $this->topic = $target->__toString(),
            $target instanceof Condition => $this->condition = $target->__toString(),
        };
    }
}
