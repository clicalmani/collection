<?php 
namespace Clicalmani\Collection\Iterators;

interface CollectionIteratorInterface extends \Iterator 
{
    /**
     * Rewind the Iterator to the first element
     * 
     * @return void
     */
	public function rewind () : void;
	
    /**
     * Return the key of the current element
     * 
     * @return int
     */
	public function key () : int;
	
    /**
     * Move forward to next element
     * 
     * @return void
     */
	public function next () : void;
	
    /**
     * Checks if current position is valid
     * 
     * @return bool
     */
	public function valid () : bool;
	
    /**
     * Return the current element
     * 
     * @return mixed
     */
	public function current () : mixed;
}
