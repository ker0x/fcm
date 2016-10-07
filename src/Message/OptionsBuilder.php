<?php
namespace ker0x\Fcm\Message;

use ker0x\Fcm\Message\Exception\InvalidOptionsException;

/**
 * Class OptionsBuilder
 *
 * @package \ker0x\Fcm\Message
 */
class OptionsBuilder
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
     * @return mixed
     */
    public function getCollapseKey()
    {
        return $this->collapseKey;
    }

    /**
     * @param string $collapseKey
     * @return \ker0x\Fcm\Message\OptionsBuilder
     */
    public function setCollapseKey(string $collapseKey): OptionsBuilder
    {
        $this->collapseKey = $collapseKey;

        return $this;
    }

    /**
     * @return bool
     */
    public function isContentAvailable()
    {
        return $this->contentAvailable;
    }

    /**
     * @param bool $contentAvailable
     * @return \ker0x\Fcm\Message\OptionsBuilder
     */
    public function setContentAvailable(bool $contentAvailable): OptionsBuilder
    {
        $this->contentAvailable = $contentAvailable;

        return $this;
    }

    /**
     * @return bool
     */
    public function isDryRun()
    {
        return $this->dryRun;
    }

    /**
     * @param bool $dryRun
     * @return \ker0x\Fcm\Message\OptionsBuilder
     */
    public function setDryRun(bool $dryRun): OptionsBuilder
    {
        $this->dryRun = $dryRun;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param string $priority
     * @return \ker0x\Fcm\Message\OptionsBuilder
     * @throws \ker0x\Fcm\Message\Exception\InvalidOptionsException
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
     * @return mixed
     */
    public function getRestrictedPackageName()
    {
        return $this->restrictedPackageName;
    }

    /**
     * @param string $restrictedPackageName
     * @return \ker0x\Fcm\Message\OptionsBuilder
     */
    public function setRestrictedPackageName(string $restrictedPackageName): OptionsBuilder
    {
        $this->restrictedPackageName = $restrictedPackageName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTimeToLive()
    {
        return $this->timeToLive;
    }

    /**
     * @param int $timeToLive
     * @return \ker0x\Fcm\Message\OptionsBuilder
     * @throws \ker0x\Fcm\Message\Exception\InvalidOptionsException
     */
    public function setTimeToLive(int $timeToLive): OptionsBuilder
    {
        if ($timeToLive < 0 || $timeToLive > 2419200) {
            throw InvalidOptionsException::invalidTimeToLive($timeToLive);
        }
        $this->timeToLive = $timeToLive;

        return $this;
    }
}
