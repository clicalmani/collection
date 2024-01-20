<?php
namespace Clicalmani\Collection;

/**
 * |--------------------------------------------------------------
 * |             ***** SPLCollection Class *****
 * |--------------------------------------------------------------
 * 
 * Collection concept is based on SPL Class ArrayObject
 * 
 * @package Clicalmani\Collection
 * @author @clicalmani
 */
class SPLCollection extends \ArrayObject
{
    /**
     * Collection element type
     * 
     * @var string
     */
    protected $type;

    /**
     * @override
     * @param mixed $index 
     * @param mixed $newval
     * @return void
     */
    public function offsetSet(mixed $index, mixed $newval) : void
    {
        if (null === $this->type) $this->type = gettype($newval);
        
        parent::offsetSet($index, $newval);
    }
}