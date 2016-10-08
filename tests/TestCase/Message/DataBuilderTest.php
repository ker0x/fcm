<?php
use Kerox\Fcm\Message\DataBuilder;
use Kerox\Fcm\Message\Exception\InvalidDataException;

class DataBuilderTest extends PHPUnit_Framework_TestCase
{
    public function testAddData()
    {
        $dataBuilder = new DataBuilder();
        $dataBuilder
            ->addData('data-1', 'data-1')
            ->addData('data-2', true)
            ->addData('data-3', 1234);

        $data = $dataBuilder->getAllData();

        $this->assertEquals([
            'data-1' => 'data-1',
            'data-2' => true,
            'data-3' => 1234,
        ], $data);
    }

    public function testRemoveData()
    {
        $dataBuilder = new DataBuilder();
        $dataBuilder
            ->addData('data-1', 'data-1')
            ->addData('data-2', true)
            ->addData('data-3', 1234)
            ->removeData('data-1');

        $data = $dataBuilder->getAllData();

        $this->assertEquals([
            'data-2' => true,
            'data-3' => 1234,
        ], $data);
    }

    public function testRemoveAllData()
    {
        $dataBuilder = new DataBuilder();
        $dataBuilder
            ->addData('data-1', 'data-1')
            ->addData('data-2', true)
            ->addData('data-3', 1234)
            ->removeAllData();

        $data = $dataBuilder->getAllData();

        $this->assertEquals([], $data);
    }

    public function testGetNonExistentData()
    {
        $this->expectException(InvalidDataException::class);
        $dataBuilder = new DataBuilder();
        $dataBuilder
            ->addData('data-1', 'data-1')
            ->addData('data-2', true)
            ->addData('data-3', 1234);

        $dataBuilder->getData('data-4');
    }
}