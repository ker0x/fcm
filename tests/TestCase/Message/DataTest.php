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
            ->setData('data-1', 'data-1')
            ->setData('data-2', true)
            ->setData('data-3', 1234);

        $data = $dataBuilder->build();
        $data = $data->toArray();

        $this->assertEquals([
            'data-1' => 'data-1',
            'data-2' => 'true',
            'data-3' => '1234',
        ], $data);
    }

    public function testDataFromArray()
    {
        $data = new Data([
            'data-1' => 'data-1',
            'data-2' => true,
            'data-3' => 1234,
        ]);
        $data = $data->toArray();

        $this->assertEquals([
            'data-1' => 'data-1',
            'data-2' => 'true',
            'data-3' => '1234',
        ], $data);
    }
}