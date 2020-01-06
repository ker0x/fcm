<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Message\Options;

use Kerox\Fcm\Model\Message\Options;

/**
 * Class WebpushOptions.
 */
class WebpushOptions extends Options
{
    /**
     * @var string|null
     */
    private $link;

    /**
     * @return \Kerox\Fcm\Model\Message\Options\WebpushOptions
     */
    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function toArray(): array
    {
        $array = parent::toArray();
        $array += [
            'link' => $this->link,
        ];

        return array_filter($array);
    }

    public static function fromArray(array $options): self
    {
        $self = new self();

        if (isset($options['link']) && \is_string($options['link'])) {
            $self->setLink($options['link']);
        }

        if (isset($options['analytics_label']) && \is_string($options['analytics_label'])) {
            $self->setAnalyticsLabel($options['analytics_label']);
        }

        return $self;
    }
}
