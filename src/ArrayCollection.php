<?php

namespace GeoBase\Countries;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use JsonSerializable;

class ArrayCollection implements Countable, IteratorAggregate, ArrayAccess, JsonSerializable
{
    /**
     * @var array
     */
    protected $elements;

    /**
     * @param array $elements
     */
    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->elements;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->elements;
    }

    /**
     * @param $key
     *
     * @return $this
     */
    public function order($key)
    {
        if (strpos($key, '.') !== false) {
            $this->orderByChildCollection(explode('.', $key));

            return $this;
        }
        trigger_error('feature not implemented'); // todo implement feature
    }

    /**
     * @param $keys
     *
     * @return $this
     */
    private function orderByChildCollection($keys)
    {
        $ordered = [];
        foreach ($this->getIterator() as $item) {
            $value = $this->getChildValueRecursive($item, $keys);
            $ordered[$value] = $item;
        }

        ksort($ordered);
        $ordered = array_values($ordered);
        $this->elements = $ordered;

        return $this;
    }

    /**
     * @param $item
     * @param $keys
     *
     * @return mixed|null
     */
    private function getChildValueRecursive($item, $keys)
    {
        $currentKey = current($keys);
        $remainingKeys = array_splice($keys, 1);
        if (method_exists($item, "get{$currentKey}")) {
            $method = "get{$currentKey}";
        } elseif (method_exists($item, $currentKey)) {
            $method = $currentKey;
        } elseif (method_exists($item, 'get')) {
            $value = $item->get($currentKey);
        }

        if (!isset($value) && isset($method)) {
            $value = call_user_func([$item, 'get'.current($keys)]);
        } elseif (!isset($value) && property_exists($item, $currentKey)) {
            $value = $item->{$currentKey};
        }

        if (isset($value)) {
            if (count($remainingKeys)) {
                return $this->getChildValueRecursive($value, $remainingKeys);
            } else {
                return $value;
            }
        }
    }

    /**
     * @param string $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->elements[$offset]) || array_key_exists($offset, $this->elements);
    }

    /**
     * @param string $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * @param string $offset
     * @param mixed  $value
     */
    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    /**
     * @param string $offset
     *
     * @return null
     */
    public function offsetUnset($offset)
    {
        return $this->remove($offset);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->elements);
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->elements);
    }

    /**
     * @param string $key
     *
     * @return null|mixed
     */
    public function get($key)
    {
        if (isset($this->elements[$key])) {
            return $this->elements[$key];
        }
    }

    /**
     * @param string $key
     * @param mixed  $value
     */
    public function set($key, $value)
    {
        $this->elements[$key] = $value;
    }

    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function add($value)
    {
        $this->elements[] = $value;

        return true;
    }

    /**
     * @param string $key
     *
     * @return null|mixed
     */
    public function remove($key)
    {
        if (isset($this->elements[$key]) || array_key_exists($key, $this->elements)) {
            $removed = $this->elements[$key];
            unset($this->elements[$key]);

            return $removed;
        }
    }
}
