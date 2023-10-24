<?php 
namespace Clicalmani\Collection;

class Set extends Collection
{
    /**
     * @override
     */
    public function add(mixed ...$elements) : static
    {
        foreach ($elements as $element) {
            if (null !== $this->type && gettype($element) !== $this->type) continue;
                    
            $this[] = $element;
        }

        return $this->unique();
    }
}
