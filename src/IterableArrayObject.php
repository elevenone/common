<?php

namespace EmbarkNow\Journey;

use IteratorAggregate;
use ArrayIterator;
use EmbarkNow\Journey\ArrayObject;

class IterableArrayObject extends ArrayObject implements IteratorAggregate
{
    public function getIterator()
    {
        return new ArrayIterator($this->store);
    }
}
