<?php

namespace CollectionTest;

use Collection\Collection;

/**
 * Class CollectionChainTest
 * @package CollectionTest
 */
class CollectionChainTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function 要素が4つの配列をselectして2つにしてからcountする()
    {
        $collection = new Collection([1, 10, 100, 1000]);
        $actual = $collection->select(function($item) {
            return $item >= 100;
        })->count();
        $this->assertSame(2, $actual);
    }

    /**
     * @test
     */
    public function 要素が4つの配列の100未満の要素だけにしてから2倍する()
    {
        $collection = new Collection([1, 10, 100, 1000]);
        $actual = $collection->select(function($item) {
            return $item < 100;
        })->map(function($item) {
            return $item * 2;
        })->all();
        $this->assertSame([2, 20], $actual);
    }

    /**
     * @test
     */
    public function getしたkeyがない場合はnullを返す()
    {
        //
    }
}
