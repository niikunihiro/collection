<?php

namespace CollectionTest;

use Collection\Collection;

class StackTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function popが最後の要素を返す事を確認()
    {
        $collection = new Collection(['foo', 'bar', 'baz']);
        $stack = $collection->pop();
        $this->assertEquals('baz', $stack);
    }

    /**
     * @test
     */
    public function popが連想配列の時は最後の要素のvalueを返す事を確認()
    {
        $collection = new Collection(['foo' => 1, 'bar' => 3]);
        $actual = $collection->pop();
        $this->assertEquals(3, $actual);
    }

    /**
     * @test
     */
    public function pushが最後に要素を追加する事を確認()
    {
        $collection = new Collection(['foo', 'bar']);
        $sum = $collection->push('baz');
        $this->assertEquals(['foo', 'bar', 'baz'], $collection->all());
        $this->assertSame(3, $sum);
    }

    /**
     * @test
     */
    public function shiftが先頭の要素を取り出す()
    {
        $collection = new Collection(['foo', 'bar', 'baz']);
        $actual = $collection->shift();
        $this->assertEquals('foo', $actual);
        $this->assertSame(['bar', 'baz'], $collection->all());
    }

    /**
     * @test
     */
    public function unshiftで先頭に要素を追加する()
    {
        $expected = ['baz', 'foo', 'bar'];
        $collection = new Collection(['foo', 'bar']);
        $sum = $collection->unshift('baz');
        $this->assertSame(3, $sum);
        $this->assertSame($expected, $collection->all());
    }
}
