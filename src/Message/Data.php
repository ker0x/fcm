<?php
namespace Kerox\Fcm\Message;

use Kerox\Fcm\Message\Exception\InvalidDataException;

/**
 * Class Data
 * @package Kerox\Fcm\Message
 */
class Data
{

    /**
     * @var array
     */
    protected $data = [];

    /**
     * Data constructor.
     *
     * @param array|\Kerox\Fcm\Message\DataBuilder $dataBuilder
     */
    public function __construct($dataBuilder)
    {
        if (is_array($dataBuilder)) {
            $dataBuilder = $this->fromArray($dataBuilder);
        }
        $this->data = $dataBuilder->getData();
    }

    /**
     * Return data as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
     * Build data from an array.
     *
     * @param array $dataArray Array of data for the notification.
     * @return \Kerox\Fcm\Message\DataBuilder
     * @throws \Kerox\Fcm\Message\Exception\InvalidDataException
     */
    private function fromArray(array $dataArray): DataBuilder
    {
        if (empty($dataArray)) {
            throw InvalidDataException::arrayEmpty();
        }

        $dataBuilder = new DataBuilder();
        foreach ($dataArray as $key => $value) {
            $dataBuilder->setData($key, $value);
        }

        return $dataBuilder;
    }
}
