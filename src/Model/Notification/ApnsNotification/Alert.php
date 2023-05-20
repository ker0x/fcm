<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Notification\ApnsNotification;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @see https://developer.apple.com/documentation/usernotifications/setting_up_a_remote_notification_server/generating_a_remote_notification#2943365
 */
final readonly class Alert
{
    /**
     * @param string[] $titleLocArgs
     * @param string[] $subtitleLocArgs
     * @param string[] $locArgs
     */
    public function __construct(
        public ?string $title = null,
        public ?string $subtitle = null,
        public ?string $body = null,
        #[SerializedName('launch-image')] public ?string $launchImage = null,
        #[SerializedName('title-loc-key')] public ?string $titleLocKey = null,
        #[SerializedName('title-loc-args')] public array $titleLocArgs = [],
        #[SerializedName('subtitle-loc-key')] public ?string $subtitleLocKey = null,
        #[SerializedName('subtitle-loc-args')] public array $subtitleLocArgs = [],
        #[SerializedName('loc-key')] public ?string $locKey = null,
        #[SerializedName('loc-args')] public array $locArgs = [],
    ) {
    }
}
