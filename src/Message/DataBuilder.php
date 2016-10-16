<?php
namespace Kerox\Fcm\Message;

use Kerox\Fcm\Message\Exception\InvalidDataException;

/**
 * Class DataBuilder
 * @package Kerox\Fcm\Message
 */
class DataBuilder implements BuilderInterface
{

    /**
     * @var null|array
     */
    protected $data = [];

    /**
     * @param string $key
     * @return mixed
     * @throws \Kerox\Fcm\Message\Exception\InvalidDataException
     */
    public function getData(string $key = null)
    {
        if ($key) {
            if (!array_key_exists($key, $this->data)) {
                throw InvalidDataException::invalidKey($key);
            }

            return $this->data[$key];
        }

        return $this->data;
    }

    /**
     * @param string $key
     * @param $value
     * @return \Kerox\Fcm\Message\DataBuilder
     */
    public function setData(string $key, $value): DataBuilder
    {
        if (is_bool($value)) {
            $value = ($value) ? 'true' : 'false';
        }
        $this->data[$key] = (string)$value;

        return $this;
    }

    /**
     * @param string $key
     * @return \Kerox\Fcm\Message\DataBuilder
     * @throws \Kerox\Fcm\Message\Exception\InvalidDataException
     */
    public function removeData(string $key = null): DataBuilder
    {
        if ($key) {
            if (!array_key_exists($key, $this->data)) {
                throw InvalidDataException::invalidKey($key);
            }
            unset($this->data[$key]);
        } else {
            $this->data = [];
        }

        return $this;
    }

    /**
     * Build the data.
     *
     * @return \Kerox\Fcm\Message\Data
     */
    public function build(): Data
    {
        return new Data($this);
    }
}
