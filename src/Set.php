<?php 
namespace Clicalmani\Collection;

class Set extends Collection
{
    /**
     * (non-PHPdoc)
     * @override
     * 
     * @param mixed ...$items
     * @return static
     */
    public function add(mixed ...$items) : static
    {
        foreach ($items as $item) {
            if (null !== $this->type && gettype($item) !== $this->type) continue;
                    
            $this[] = $item;
        }

        return $this->unique();
    }
}
