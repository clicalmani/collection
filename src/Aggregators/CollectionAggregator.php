<?php 
namespace Clicalmani\Collection\Aggregators;

use Clicalmani\Collection\Iterators\CollectionIteratorInterface;

abstract class CollectionAggregator extends \ArrayIterator
{
    /**
     * Iterator index
     * 
     * @var int
     */
    protected int $key;

    /**
     * Holds the aggregator length
     * 
     * @var int
     */
    public $length = 0;

    /**
     * Storage
     * 
     * @var mixed
     */
    protected $storage;

    /**
     * @override
     * @return void
     */
	public function rewind () : void
    {
        $this->key = 0;
    }
	
    /**
     * @override
     * @return int
     */
	public function key () : int
    {
        return $this->key;
    }
	
    /**
     * @override
     * @return void
     */
	public function next () : void
    {
        $this->key++;
    }
	
    /**
     * @override
     * @return bool
     */
	public function valid () : bool
    {
        return $this->key < $this->length;
    }
	
    /**
     * @override
     * @return mixed
     */
	public function current () : mixed
    {
        return $this->item($this->key);
    }

    /**
     * @override
     * @return mixed
     */
    abstract public function item(int $index) : mixed;

    /**
     * @override
     * @return void
     */
    abstract public function add(mixed $item) : void;
}
