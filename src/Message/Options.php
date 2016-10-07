<?php
namespace ker0x\Fcm\Message;

use ker0x\Fcm\Message\Exception\InvalidOptionsException;
use ker0x\Fcm\UtilityAwareTrait;

/**
 * Class Options
 * @package ker0x\Fcm\Message
 */
class Options implements BuilderInterface
{

    use UtilityAwareTrait;

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
     * @param array|\ker0x\Fcm\Message\OptionsBuilder $optionsBuilder
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
    public function build(): array
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
     * @return \ker0x\Fcm\Message\OptionsBuilder
     * @throws \ker0x\Fcm\Message\Exception\InvalidOptionsException
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
