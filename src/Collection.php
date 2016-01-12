<?php

namespace Collection;

use Closure;

/**
 * Class Collection
 * @package Collection
 */
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
     * @param Closure $callback
     * @param int $flag
     * @return static
     */
    public function select(Closure $callback, $flag = 0)
    {
        $this->collection = array_filter($this->collection, $callback, $flag);

        return new static($this->collection);
    }

    /**
     * @param Closure $callback
     * @return static
     */
    public function map(Closure $callback)
    {
        $this->collection = array_map($callback, $this->collection);

        return new static($this->collection);
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
     * @param Closure $callback
     * @param null $initial
     * @return mixed
     */
    public function reduce(Closure $callback, $initial = NULL)
    {
        return array_reduce($this->collection, $callback, $initial);
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

    /**
     * @param $keys
     * @return $this
     */
    public function forget($keys)
    {
        $this->unset_r((array)$keys);
        return $this;
    }

    /**
     * @return static
     */
    public function values()
    {
        $this->collection = array_values($this->collection);

        return new static($this->collection);
    }

    /**
     * @param array $keys
     */
    protected function unset_r(array $keys)
    {
        array_walk_recursive($keys, function($key) {
            unset($this->collection[$key]);
        });
    }
}