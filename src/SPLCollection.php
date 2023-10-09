<?php
namespace Clicalmani\Collection;

/**
 * |--------------------------------------------------------------
 * |             ***** SPLCollection Class *****
 * |--------------------------------------------------------------
 * 
 * Collection concept is based on SPL Class ArrayObject
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
        parent::offsetSet($index, $newval);
    }
}