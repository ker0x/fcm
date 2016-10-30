<?php
namespace Kerox\Fcm\Test\TestCase\Message;

use Kerox\Fcm\Message\DataBuilder;
use Kerox\Fcm\Message\Exception\InvalidDataException;
use Kerox\Fcm\Test\TestCase\AbstractTestCase;

class DataBuilderTest extends AbstractTestCase
{
    public function testSetData()
    {
        $dataBuilder = new DataBuilder();
        $dataBuilder
            ->setData('data-1', 'data-1')
            ->setData('data-2', true)
            ->setData('data-3', 1234);

        $data = $dataBuilder->getData();

        $this->assertEquals([
            'data-1' => 'data-1',
            'data-2' => 'true',
            'data-3' => '1234',
        ], $data);
    }

    public function testGetData()
    {
        $dataBuilder = new DataBuilder();
        $dataBuilder
            ->setData('data-1', 'data-1')
            ->setData('data-2', true)
            ->setData('data-3', 1234);

        $data = $dataBuilder->getData('data-2');

        $this->assertEquals('true', $data);
    }

    public function testGetNonExistentData()
    {
        $this->expectException(InvalidDataException::class);
        $dataBuilder = new DataBuilder();
        $dataBuilder
            ->setData('data-1', 'data-1')
            ->setData('data-2', true)
            ->setData('data-3', 1234);

        $dataBuilder->getData('data-4');
    }

    public function testRemoveData()
    {
        $dataBuilder = new DataBuilder();
        $dataBuilder
            ->setData('data-1', 'data-1')
            ->setData('data-2', true)
            ->setData('data-3', 1234)
            ->removeData('data-1');

        $data = $dataBuilder->getData();

        $this->assertEquals([
            'data-2' => 'true',
            'data-3' => '1234',
        ], $data);
    }

    public function testRemoveAllData()
    {
        $dataBuilder = new DataBuilder();
        $dataBuilder
            ->setData('data-1', 'data-1')
            ->setData('data-2', true)
            ->setData('data-3', 1234)
            ->removeData();

        $data = $dataBuilder->getData();

        $this->assertEquals([], $data);
    }

    public function testRemoveNonExistentData()
    {
        $this->expectException(InvalidDataException::class);
        $dataBuilder = new DataBuilder();
        $dataBuilder
            ->setData('data-1', 'data-1')
            ->setData('data-2', true)
            ->setData('data-3', 1234);

        $dataBuilder->removeData('data-4');
    }
}