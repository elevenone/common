<?php

namespace EmbarkNow;

use ArrayAccess;
use Serializable;
use Countable;

class ArrayObject implements ArrayAccess, Serializable, Countable
{
    /**
     * @var array
     */
    protected $store;

    /**
     * Construct an instance from an array or no data
     * @param array $input
     */
    public function __construct(array $input = [])
    {
        $this->store = [];
        $this->setArray($input);
    }

    /**
     * Apply an array to this instance
     * @param array $input
     */
    public function setArray(array $input)
    {
        foreach ($input as $key => $value) {
            $this->offsetSet($key, $value);
        }
    }

    /**
     * Get this instance as a pure array
     * @return array
     */
    public function getArray()
    {
        return array_map(function ($item) {
            return ($item instanceof ArrayObject ? $item->getArray() : $item);
        }, $this->store);
    }

    /**
     * Set a key => value pair
     * Creates instance of self for associative arrays
     * @param  string  $key
     * @param  mixed   $value
     * @return mixed
     */
    public function offsetSet($key, $value)
    {
        return $this->store[$key] = (
            is_array($value) && (bool)count(array_filter(array_keys($value), 'is_string'))
            ? new self($value)
            : $value
        );
    }

    /**
     * @see self::offsetSet
     */
    public function __set($key, $value)
    {
        return $this->offsetSet($key, $value);
    }

    /**
     * Get a value by it's key
     * @param  string $key
     * @return mixed
     */
    public function &offsetGet($key)
    {
        $value = null;

        if (isset($this->store[$key])) {
            $value = &$this->store[$key];
        }

        return $value;
    }

    /**
     * @see self::offsetGet
     */
    public function &__get($key)
    {
        return $this->offsetGet($key);
    }

    /**
     * Check a key exists
     * @param  string $key
     * @return boolean
     */
    public function offsetExists($key)
    {
        return array_key_exists($key, $this->store);
    }

    /**
     * @see self::offsetExists
     */
    public function __isset($key)
    {
        return $this->offsetExists($key);
    }

    /**
     * Remove an item by it's key
     * @param  string $key
     * @return mixed
     */
    public function offsetUnset($key)
    {
        unset($this->store[$key]);
    }

    /**
     * @see self::offsetUnset
     */
    public function __unset($key)
    {
        $this->offsetUnset($key);
    }

    /**
     * Return the string representation of the object
     * @return string
     */
    public function serialize()
    {
        return serialize($this->store);
    }

    /**
     * Construct an object with provided serialized data
     * @param  string $input
     */
    public function unserialize($input)
    {
        $this->store = unserialize($input);
    }

    /**
     * Count the elements of the store
     * @return integer
     */
    public function count()
    {
        return count($this->store);
    }
}
