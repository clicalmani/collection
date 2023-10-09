<?php 
namespace Clicalmani\Collection\Aggregators;

class ArrayIteratorAggregate extends CollectionAggregator implements \ArrayAccess
{
    public function __construct(mixed $storage)
    {
        $this->storage = $storage;
        $this->length = count($storage);
    }

    /**
     * Add new item
     * 
     * @param mixed $item
     * @return void
     */
    public function add(mixed $item): void
    {
        $this->storage[] = $item; 
        $this->length++;
    }

    /**
     * Whether a offset exists
     * 
     * @param int $index Offset index
     * @return bool
     */
    public function offsetExists (mixed $index) : bool
    {
        return array_key_exists($index, $this->storage) ? true: false;
    }
	
    /**
     * Offset to retrieve
     * 
     * @param int $index Offset index
     * @return mixed
     */
	public function offsetGet (mixed $index) : mixed
    {
        return $this->storage[$index];
    }
	
    /**
     * Offset to set
     * 
     * @param int $index Offset index
     */
	public function offsetSet (mixed $index, mixed $item) : void
    {
        $this->storage[$index] = $item;
    }
	
    /**
     * Offset to unset
     * 
     * @param int $index Offset index
     * @return void
     */
	public function offsetUnset (mixed $index) : void
    {
        unset($this->storage[$index]);
        $this->length--;
    }

    /**
     * Return the current iterator
     * 
     * @return \Traversable
     */
    // public function getIterator(): \Traversable
    // {
    //     return $this;
    // }

    public function item(int $index): mixed
    {
        return $this->storage[$index];
    }
}
