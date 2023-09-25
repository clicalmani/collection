<?php
namespace Clicalmani\Flesco\Collection;

/**
 * |--------------------------------------------------------------
 * |             ***** SPLCollection Class *****
 * |--------------------------------------------------------------
 * 
 * Collection concept is based on SPL Class ArrayObject
 */

class SPLCollection extends \ArrayObject
{
    public function offsetSet($index, $newval) : void
    {
        parent::offsetSet($index, $newval);
    }
}