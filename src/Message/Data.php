<?php
namespace ker0x\Fcm\Message;

use ker0x\Fcm\Message\DataBuilder;

/**
 * Class Data
 * @package ker0x\Fcm\Message
 */
class Data implements BuilderInterface
{

    /**
     * @var array
     */
    protected $data = [];

    /**
     * Data constructor.
     * @param array|\ker0x\Fcm\Message\DataBuilder $dataBuilder
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