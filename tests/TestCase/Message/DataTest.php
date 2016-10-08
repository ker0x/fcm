<?php
namespace Kerox\Fcm\Test\TestCase\Message;

use Kerox\Fcm\Message\Data;
use Kerox\Fcm\Message\DataBuilder;
use Kerox\Fcm\Test\TestCase\AbstractTestCase;

class DataTest extends AbstractTestCase
{
    public function testDataFromDataBuilder()
    {
        $dataBuilder = new DataBuilder();
        $dataBuilder
            ->addData('data-1', 'data-1')
            ->addData('data-2', true)
            ->addData('data-3', 1234);

        $data = new Data($dataBuilder);
        $data = $data->build();

        $this->assertEquals([
            'data-1' => 'data-1',
            'data-2' => true,
            'data-3' => 1234,
        ], $data);
    }

    public function testDataFromArray()
    {
        $data = new Data([
            'data-1' => 'data-1',
            'data-2' => true,
            'data-3' => 1234,
        ]);
        $data = $data->build();

        $this->assertEquals([
            'data-1' => 'data-1',
            'data-2' => true,
            'data-3' => 1234,
        ], $data);
    }
}