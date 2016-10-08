<?php
namespace Kerox\Fcm\Message;

use Kerox\Fcm\Message\Exception\InvalidDataException;

/**
 * Class DataBuilder
 * @package Kerox\Fcm\Message
 */
class DataBuilder
{

    /**
     * @var null|array
     */
    protected $data = [];

    /**
     * @param string $key
     * @param $value
     * @return \Kerox\Fcm\Message\DataBuilder
     */
    public function addData(string $key, $value): DataBuilder
    {
        $this->data[$key] = $value;

        return $this;
    }

    /**
     * @param string $key
     * @return mixed
     * @throws \Kerox\Fcm\Message\Exception\InvalidDataException
     */
    public function getData(string $key)
    {
        if (!array_key_exists($key, $this->data)) {
            throw InvalidDataException::invalidKey($key);
        }
        return $this->data[$key];
    }

    /**
     * @param array $data
     * @return \Kerox\Fcm\Message\DataBuilder
     */
    public function setData(array $data): DataBuilder
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getAllData(): array
    {
        return $this->data;
    }

    /**
     * @param string $key
     * @return \Kerox\Fcm\Message\DataBuilder
     */
    public function removeData(string $key): DataBuilder
    {
        unset($this->data[$key]);

        return $this;
    }

    /**
     * Remove all data
     *
     * @return void
     */
    public function removeAllData()
    {
        $this->data = [];
    }
}