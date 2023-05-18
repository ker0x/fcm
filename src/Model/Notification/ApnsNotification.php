<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Notification;

use Kerox\Fcm\Model\Notification\ApnsNotification\Alert;
use Kerox\Fcm\Model\Notification\ApnsNotification\Sound;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @see https://developer.apple.com/documentation/usernotifications/setting_up_a_remote_notification_server/generating_a_remote_notification
 */
final readonly class ApnsNotification
{
    public function __construct(
        public ?Alert $alert = null,
        public int $badge = 0,
        public string|Sound|null $sound = null,
        #[SerializedName('thread-id')] public ?string $threadId = null,
        public ?string $category = null,
        #[SerializedName('content-available')] public int $contentAvailable = 0,
        #[SerializedName('mutable-content')] public int $mutableContent = 0,
        #[SerializedName('target-content-id')] public ?string $targetContentId = null,
        #[SerializedName('interruption-level')] public ?string $interruptionLevel = null,
        #[SerializedName('relevance-score')] public float $relevanceScore = 0,
        #[SerializedName('filter-criteria')] public ?string $filterCriteria = null,
        #[SerializedName('stale-date')] public ?int $staleDate = null,
        #[SerializedName('content-state')] public ?string $contentState = null,
        public ?int $timestamp = null,
        public ?string $events = null,
    ) {
    }
}
