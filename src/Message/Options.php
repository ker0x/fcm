<?php
namespace Kerox\Fcm\Message;

use Kerox\Fcm\Message\Exception\InvalidOptionsException;

/**
 * Class Options
 * @package Kerox\Fcm\Message
 */
class Options
{

    use BuilderAwareTrait;

    /**
     * @var null|string
     */
    protected $collapseKey;

    /**
     * @var bool
     */
    protected $contentAvailable = false;

    /**
     * @var bool
     */
    protected $dryRun = false;

    /**
     * @var null|string
     */
    protected $priority;

    /**
     * @var null|string
     */
    protected $restrictedPackageName;

    /**
     * @var null|int
     */
    protected $timeToLive;

    /**
     * Options constructor.
     * @param array|\Kerox\Fcm\Message\OptionsBuilder $optionsBuilder
     */
    public function __construct($optionsBuilder)
    {
        if (is_array($optionsBuilder)) {
            $optionsBuilder = $this->fromArray($optionsBuilder);
        }

        $this->collapseKey = $optionsBuilder->getCollapseKey();
        $this->priority = $optionsBuilder->getPriority();
        $this->restrictedPackageName = $optionsBuilder->getRestrictedPackageName();
        $this->timeToLive = $optionsBuilder->getTimeToLive();
        $this->contentAvailable = $optionsBuilder->isContentAvailable() ?? null;
        $this->dryRun = $optionsBuilder->isDryRun() ?? null;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $options = [
            'collapse_key' => $this->collapseKey,
            'content_available' => $this->contentAvailable,
            'dry_run' => $this->dryRun,
            'priority' => $this->priority,
            'restricted_package_name' => $this->restrictedPackageName,
            'time_to_live' => $this->timeToLive,
        ];

        return array_filter($options);
    }

    /**
     * @param array $optionsArray
     * @return \Kerox\Fcm\Message\OptionsBuilder
     * @throws \Kerox\Fcm\Message\Exception\InvalidOptionsException
     */
    private function fromArray(array $optionsArray): OptionsBuilder
    {
        if (empty($optionsArray)) {
            throw InvalidOptionsException::arrayEmpty();
        }

        $optionsBuilder = new OptionsBuilder();
        foreach ($optionsArray as $key => $value) {
            $key = self::camelize($key);
            $setter = 'set' . $key;
            $optionsBuilder->$setter($value);
        }

        return $optionsBuilder;
    }
}
