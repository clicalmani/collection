<?php
namespace Clicalmani\Flesco\Collection;

/**
 * |------------------------------------------------------------------
 * |                 ***** Collection Class *****
 * |------------------------------------------------------------------
 * 
 * Collection Objects are traversable, countable and can be converted to JSON.
 */
class Collection extends SPLCollection 
{
    /**
     * Adds new element to the collection
     * 
     * @param mixed $element Element to be added
     * @return \Clicalmani\Flesco\Collection\Collection for chaining purpose.
     */
    function add($element) : \Clicalmani\Flesco\Collection\Collection
    {
        $this->append($element);

        return $this;
    }

    /**
     * Gets element at the specified index
     * 
     * @param mixed $index Element index (integer), null means not specified
     * @return mixed The element at the specified index if found, otherwise 
     *      \Clicalmani\Flesco\Collection\Collection is returned for chaining purpose.
     */
    function get(mixed $index = null) : mixed
    {
        if ( isset( $index ) AND isset( $this[$index] ) ) {
            return $this[$index];
        }

        return $this;
    }

    /**
     * Gets the first element in the collection
     * 
     * @return mixed first element in the collection.
     */
    function first() : mixed
    {
        return $this->get(0);
    }

    /**
     * Gets the last element in the collection
     * 
     * @return mixed last element in the collection
     */
    function last() : mixed
    {
        return $this[$this->count() - 1];
    }

    /**
     * Alter each collection element value with the result of a callback function 
     * passed as first argument.The current collection is immediately mutated.
     * 
     * @param \Closure $closure Callback function passed by argument
     * @return \Clicalmani\Flesco\Collection for chaining purpose.
     */
    function map(\Closure $closure) : \Clicalmani\Flesco\Collection\Collection
    {
        foreach ($this as $key => $value) {
            $this[$key] = $closure($value, $key);
        }

        return $this;
    }

    /**
     * Execute a given function on each element of the collection.
     * 
     * @param \Closure $closure The function to use for each element of the collection. 
     *      it takes into account two arguments:
     *      - the first argument is the elment value
     *      - the second argument is the element index
     * @return Clicalmani\Flesco\Collection\Collection for chaining purpose.
     */
    function each(\Closure $closure) : \Clicalmani\Flesco\Collection\Collection
    {
        foreach ($this as $key => $value) {
            $closure($value, $key);
        }

        return $this;
    }

    /**
     * Creates a shallow copiy of a portion of the current collection. Filter down to the 
     * elements that pass the test implementated by the provided callback function.
     * 
     * @param \Closure $closure Callback function
     * @return \Clicalmani\Flesco\Collection\Collection for chaining purpose.
     */
    function filter(\Closure $closure) : \Clicalmani\Flesco\Collection\Collection
    {
        $new = [];
        foreach ($this as $key => $value)
        {
            if ($closure($value, $key)) {
                $new[] = $value;
            }
        }

        $this->exchange($new);

        return $this;
    }

    /**
     * Merges the provided element(s) into the collection by appending them to the end of the collection.
     * 
     * @param mixed $value A single element or an array of elements
     * @return \Clicalmani\Flesco\Collection\Collection fro chaining purpose.
     */
    function merge(mixed $value) : \Clicalmani\Flesco\Collection\Collection
    {
        if ( !is_array($value) ) $value = [$value];

        $this->exchange(
            array_merge((array) $this, $value)
        );

        return $this;
    }

    /**
     * Verifies wether the collection is empty.
     * 
     * @return bool true on success, or false otherwise.
     */
    function isEmpty() : bool
    {
        return $this->count() === 0;
    }

    /**
     * Verify wether an element exists at the given index.
     * 
     * @param int $index element index to check
     * @return bool true on success, or false otherwise.
     */
    function exists(int $index) : bool
    {
        return isset($this[$index]);
    }

    /**
     * Copies the current collection into a tmeporaly array.
     * 
     * @return array The result array
     */
    function copy() : array
    {
        return $this->getArrayCopy();
    }

    /**
     * Exchange the collection elements with specified elements in an array passed by argument
     * 
     * @param array $array new collection elements array
     * @return \Clicalmani\Flesco\Collection\Collection
     */
    function exchange(array $array) : \Clicalmani\Flesco\Collection\Collection
    {
        $this->exchangeArray($array);
        return $this;
    }

    /**
     * Removes duplicate element from the collection. If two or more values are the same, the first appearance will be kept.
     * Note this method rebuild the collection, which means items keys orders are not kept.
     * 
     * @param mixed $closure [optional] an optional callback function to be executed on each element of the collection. It implements
     *      the uniqueness of the element and return the value to be test.
     * @return \Clicalmani\Flesco\Collection\Collection
     */
    function unique(mixed $closure = null) : \Clicalmani\Flesco\Collection\Collection
    {
        if (!isset($closure)) return $this->exchange(array_unique( $this->toArray() ));

        $stack  = [];
        $filter = [];
        foreach ($this as $key => $value)
        {
            $v = $closure($value, $key);
            if (!in_array($v, $filter)) {
                $stack[] = $value;
                $filter[] = $v;
            }
        }

        return $this->exchange($stack);
    }

    /**
     * Sort the collection by values using a user-defined comparison function and maintain the index association.
     * 
     * @param \Closure $closure a comparison function
     * @return \Clicalmani\Flesco\Collection\Collection
     */
    function sort($closure)
    {
        $this->uasort($closure);
        return $this;
    }

    function join($delimiter)
    {
        return join($delimiter, $this->toArray());
    }
    
    /**
     * Returns the array representation of the collection.
     * 
     * @return array the result array
     */
    function toArray()
    {
        return (array) $this;
    }

    /**
     * Convert the current collection to array object
     * 
     * @return \Clicalmani\Flesco\Collection\Collection
     */
    function toObject()
    {
        $this->setFlags(parent::ARRAY_AS_PROPS);
        return $this;
    }
}
