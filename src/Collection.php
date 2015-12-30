<?php

namespace Collection;

use Closure;

class Collection {

    /** @var array  */
    private $collection;

    /**
     * Collection constructor.
     * @param array $arr
     */
    public function __construct(array $arr)
    {
        $this->collection = $arr;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->collection;
    }

    /**
     * @param Closure $func
     * @return $this
     */
    public function select(Closure $func)
    {
        $this->collection = array_filter($this->collection, $func);

        return $this;
    }


    /**
     * @param Closure $func
     * @return $this
     */
    public function map(Closure $func)
    {
        $this->collection = array_map($func, $this->collection);

        return $this;
    }

    /**
     * @param Closure $callback
     * @param null $initial
     * @return mixed
     */
    public function reduce(Closure $callback, $initial = NULL)
    {
        return array_reduce($this->collection, $callback, $initial);
    }

    /**
     * @param array $keys
     * @return $this
     */
    public function except(array $keys)
    {
        $this->collection = array_diff_key(
            $this->collection,
            array_fill_keys($keys, '')
        );

        return $this;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->collection);
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return array_key_exists($key, $this->collection);
    }

    /**
     * @param $key
     * @param null $default
     * @return null
     */
    public function get($key, $default = null)
    {
        if (!$this->has($key)) {
            return $default;
        }

        return $this->collection[$key];
    }
}