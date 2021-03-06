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
     * @param array $items
     */
    public function __construct(array $items)
    {
        $this->collection = $items;
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

        return new static($this->collection);
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

        return new static($this->collection);
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
     * @param array $items
     * @return static
     */
    public function merge(array $items)
    {
        $this->collection = array_merge($this->collection, $items);

        return new static($this->collection);
    }

    /**
     * @param array $items
     * @return static
     */
    public function merge_recursive(array $items)
    {
        $this->collection = array_merge_recursive($this->collection, $items);

        return new static($this->collection);
    }

    /**
     * @return mixed
     */
    public function pop()
    {
        return array_pop($this->collection);
    }

    /**
     * @param $value
     * @return int
     */
    public function push($value)
    {
        return array_push($this->collection, $value);
    }

    /**
     * @return mixed
     */
    public function shift()
    {
        return array_shift($this->collection);
    }

    /**
     * @param $value
     * @return int
     */
    public function unshift($value)
    {
        return array_unshift($this->collection, $value);
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