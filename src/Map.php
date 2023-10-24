<?php 
namespace Clicalmani\Collection;

class Map extends Collection
{
    /**
     * @override
     */
    public function set(mixed $key, mixed $value) : static
    {
        if (null === $this->get($key)) $this[] = (object) ['key' => $key, 'value' => $value];

        return $this;
    }

    public function get(mixed $key = null) : mixed
    {
        foreach ($this as $element) 
            if ($element->key === $key) return $element->value;
            
        return null;
    }

    /**
     * Delete element by key
     * 
     * @param mixed $key
     * @return static
     */
    public function delete(mixed $key) : static
    {
        $new_map = [];

        foreach ($this as $element)
            if ($element->key !== $key) $new_map[] = $element;

        return $this->exchange($new_map);
    }
}
