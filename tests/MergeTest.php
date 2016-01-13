<?php

namespace CollectionTest;

use Collection\Collection;

class MergeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function 連想配列がマージされている事を確認()
    {
        $expected   = ['id' => 1, 'name' => 'nielsen', 'email' => 'nelsen@poulsen.com', 'address' => 'Osaka city'];
        $collection = new Collection(['id' => 1, 'name' => 'nielsen']);
        $actual     = $collection->merge(['email' => 'nelsen@poulsen.com', 'address' => 'Osaka city'])->all();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function 連想配列の重複がマージされている事を確認()
    {
        $expected   = ['id' => 1, 'name' => 'poulsen', 'email' => 'poulsen@poulsen.com'];
        $collection = new Collection(['id' => 1, 'name' => 'nielsen']);
        $actual     = $collection->merge(['name' => 'poulsen', 'email' => 'poulsen@poulsen.com'])->all();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function 添字配列がマージされている事を確認()
    {
        $expected   = ['foo', 'bar', 'baz', 'qux'];
        $collection = new Collection(['foo', 'bar']);
        $actual     = $collection->merge(['baz', 'qux'])->all();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function 添字配列の重複が追記されている事を確認()
    {
        $expected = ['foo', 'bar', 'baz', 'bar', 'baz', 'qux'];
        $actual   = (new Collection(['foo', 'bar', 'baz']))->merge(['bar', 'baz', 'qux'])->all();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function 配列を再帰的にマージできてる事を確認()
    {
        $expected = [
            'color' => ['red', 'green'],
            'sky',
            1,
            2,
            'wood',
        ];
        $actual   = (new Collection(['color' => 'red', 'sky', 1]))->merge_recursive([
                2,
                'wood',
                'color' => 'green'
            ])->all();
        $this->assertEquals($expected, $actual);
    }
}
