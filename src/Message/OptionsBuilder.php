<?php
namespace Kerox\Fcm\Message;

use Kerox\Fcm\Message\Exception\InvalidOptionsException;

/**
 * Class OptionsBuilder
 *
 * @package \Kerox\Fcm\Message
 */
class OptionsBuilder implements BuilderInterface
{

    /**
     *
     */
    const NORMAL = 'normal';
    /**
     *
     */
    const HIGH = 'high';

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
     * Getter for collapseKey.
     *
     * @return mixed
     */
    public function getCollapseKey()
    {
        return $this->collapseKey;
    }

    /**
     * Setter for collapseKey.
     *
     * @param string $collapseKey
     * @return \Kerox\Fcm\Message\OptionsBuilder
     */
    public function setCollapseKey(string $collapseKey): OptionsBuilder
    {
        $this->collapseKey = $collapseKey;

        return $this;
    }

    /**
     * Getter for contentAvailable.
     *
     * @return bool
     */
    public function isContentAvailable()
    {
        return $this->contentAvailable;
    }

    /**
     * Setter for contentAvailable.
     *
     * @param bool $contentAvailable
     * @return \Kerox\Fcm\Message\OptionsBuilder
     */
    public function setContentAvailable(bool $contentAvailable): OptionsBuilder
    {
        $this->contentAvailable = $contentAvailable;

        return $this;
    }

    /**
     * Getter for dryRun.
     *
     * @return bool
     */
    public function isDryRun()
    {
        return $this->dryRun;
    }

    /**
     * Setter for dryRun.
     *
     * @param bool $dryRun
     * @return \Kerox\Fcm\Message\OptionsBuilder
     */
    public function setDryRun(bool $dryRun): OptionsBuilder
    {
        $this->dryRun = $dryRun;

        return $this;
    }

    /**
     * Getter for priority.
     *
     * @return mixed
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Setter for priority.
     *
     * @param string $priority
     * @return \Kerox\Fcm\Message\OptionsBuilder
     * @throws \Kerox\Fcm\Message\Exception\InvalidOptionsException
     */
    public function setPriority(string $priority): OptionsBuilder
    {
        if (!in_array($priority, [self::NORMAL, self::HIGH])) {
            throw InvalidOptionsException::invalidPriority();
        }
        $this->priority = $priority;

        return $this;
    }

    /**
     * Getter for restrictedPackageName.
     *
     * @return mixed
     */
    public function getRestrictedPackageName()
    {
        return $this->restrictedPackageName;
    }

    /**
     * Setter for restrictedPackageName.
     *
     * @param string $restrictedPackageName
     * @return \Kerox\Fcm\Message\OptionsBuilder
     */
    public function setRestrictedPackageName(string $restrictedPackageName): OptionsBuilder
    {
        $this->restrictedPackageName = $restrictedPackageName;

        return $this;
    }

    /**
     * Getter for timeToLive.
     *
     * @return mixed
     */
    public function getTimeToLive()
    {
        return $this->timeToLive;
    }

    /**
     * Setter for timeToLive.
     *
     * @param int $timeToLive
     * @return \Kerox\Fcm\Message\OptionsBuilder
     * @throws \Kerox\Fcm\Message\Exception\InvalidOptionsException
     */
    public function setTimeToLive(int $timeToLive): OptionsBuilder
    {
        if ($timeToLive < 0 || $timeToLive > 2419200) {
            throw InvalidOptionsException::invalidTimeToLive($timeToLive);
        }
        $this->timeToLive = $timeToLive;

        return $this;
    }

    /**
     * Build the options.
     *
     * @return \Kerox\Fcm\Message\Options
     */
    public function build(): Options
    {
        return new Options($this);
    }
}
