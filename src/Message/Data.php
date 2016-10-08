<?php
namespace Kerox\Fcm\Message;

/**
 * Class Data
 * @package Kerox\Fcm\Message
 */
class Data implements BuilderInterface
{

    /**
     * @var array
     */
    protected $data = [];

    /**
     * Data constructor.
     * @param array|\Kerox\Fcm\Message\DataBuilder $dataBuilder
     */
    public function __construct($dataBuilder)
    {
        if ($dataBuilder instanceof DataBuilder) {
            $dataBuilder = $dataBuilder->getAllData();
        }
        $this->data = $dataBuilder;
    }

    /**
     * @return array
     */
    public function build(): array
    {
        return $this->data;
    }
}