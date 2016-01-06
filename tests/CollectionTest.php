<?php

namespace CollectionTest;

use Collection\Collection;

/**
 * Class CollectionTest
 * @package CollectionTest
 */
class CollectionTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function selectが条件に一致する要素数を返す()
    {
        $collection = new Collection([1, 2, 3]);
        $result     = $collection->select(function ($data) {
            return $data === 2;
        })->all();
        $this->assertEquals(1, count($result));
    }

    /**
     * @test
     */
    public function mapが各要素を2倍した配列を返す()
    {
        $collection = new Collection([1, 2, 4]);
        $actual     = $collection->map(function ($data) {
            return $data * 2;
        })->all();
        $this->assertEquals([2, 4, 8], $actual);
    }

    /**
     * @test
     */
    public function countが要素数を返す()
    {
        $collection = new Collection([1, 2, 4]);
        $this->assertSame(3, $collection->count());
    }

    /**
     * @test
     */
    public function hasがtrueを返す()
    {
        $collection = new Collection(['foo' => 'bar']);
        $this->assertTrue($collection->has('foo'));
    }

    /**
     * @test
     */
    public function hasがfalseを返す()
    {
        $collection = new Collection(['foo' => 'bar']);
        $this->assertFalse($collection->has('bar'));
    }

    /**
     * @test
     */
    public function exceptが指定した配列の要素を除外した配列を返す()
    {
        $collection = new Collection(['product_id' => 1, 'name' => 'Desk', 'price' => 100, 'discount' => false]);
        $filtered   = $collection->except(['price', 'discount']);

        $this->assertEquals(['product_id' => 1, 'name' => 'Desk'], $filtered->all());
    }

    /**
     * @test
     */
    public function reduceで足し算する()
    {
        $collection = new Collection([1, 2, 3, 4, 5]);
        $actual     = $collection->reduce(function ($carry, $item) {
            return $carry + $item;
        });
        $this->assertSame(15, $actual);
    }

    /**
     * @test
     */
    public function reduceでかけ算する()
    {
        $collection = new Collection([1, 2, 3, 4, 5]);
        $actual     = $collection->reduce(function ($carry, $item) {
            return $carry * $item;
        }, 1);
        $this->assertSame(120, $actual);
    }

    /**
     * @test
     */
    public function getで値を取得する()
    {
        $collection = new Collection(['foo' => 'bar']);
        $actual = $collection->get('foo');
        $this->assertSame('bar', $actual);
    }

    /**
     * @test
     */
    public function getでdefault値が返る()
    {
        $default = 'default-value';
        $collection = new Collection(['foo' => 'bar']);
        $actual = $collection->get('fizz', $default);
        $this->assertEquals($default, $actual);
    }

    /**
     * @test
     */
    public function forgetで要素を削除する()
    {
        $collection = new Collection(['foo' => 1, 'bar' => 2]);
        $collection->forget('foo');
        $this->assertFalse($collection->has('foo'));
        $this->assertTrue($collection->has('bar'));
    }

    /**
     * @test
     */
    public function forgetで複数要素を削除する()
    {
        $collection = new Collection(['foo' => 1, 'bar' => 2, 'baz' => 3]);
        $collection->forget(['foo', 'bar']);
        $this->assertFalse($collection->has('foo'));
        $this->assertFalse($collection->has('bar'));
        $this->assertTrue($collection->has('baz'));
    }
}