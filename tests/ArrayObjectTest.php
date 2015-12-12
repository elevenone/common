<?php

namespace EmbarkNow\Tests;

use EmbarkNow\ArrayObject;

/**
 * ArrayObject Test
 */
class ArrayObjectTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->object = new ArrayObject;
        $this->data = [
            'badger' => 'mushroom',
            'sub' => [
                'badger' => 'mushroom',
                'sub' => [
                    'badger' => 'mushroom'
                ]
            ]
        ];
    }

    public function getInternal($source)
    {
        $reflection = new \ReflectionClass($this->object);
        $property = $reflection->getProperty($source);
        $property->setAccessible(true);

        return $property->getValue($this->object);
    }

    public function testSetArray()
    {
        $this->object->setArray($this->data);

        $data = $this->getInternal('store');

        $this->assertArrayHasKey('badger', $data);
    }

    public function testSetNested()
    {
        $this->object->setNested($this->data);

        $data = $this->getInternal('store');

        $this->assertArrayHasKey('badger', $data);
        $this->assertInstanceOf('EmbarkNow\ArrayObject', $data['sub']);
    }

    public function testSetProperty()
    {
        $this->object->badger = 'mushroom';

        $data = $this->getInternal('store');

        $this->assertEquals('mushroom', $data['badger']);
    }

    public function testSetElement()
    {
        $this->object['badger'] = 'mushroom';

        $data = $this->getInternal('store');

        $this->assertEquals('mushroom', $data['badger']);
    }

    public function testGetProperty()
    {
        $this->object = new ArrayObject($this->data);
        $this->assertEquals('mushroom', $this->object->badger);
    }

    public function testGetElement()
    {
        $this->object = new ArrayObject($this->data);
        $this->assertEquals('mushroom', $this->object['badger']);
    }

    public function testGetNestedElement()
    {
        $this->object = new ArrayObject($this->data);
        $this->assertEquals('mushroom', $this->object['sub']['badger']);
    }

    public function testGetArray()
    {
        $this->object = new ArrayObject($this->data);
        $this->assertInternalType('array', $this->object->getArray());
    }

    public function testIssetByArray()
    {
        $this->collection = new ArrayObject($this->data);

        $this->assertTrue(isset($this->collection['badger']));
    }

    public function testIssetByMagic()
    {
        $this->collection = new ArrayObject($this->data);

        $this->assertTrue(isset($this->collection->badger));
    }

    public function testUnsetByArray()
    {
        $this->collection = new ArrayObject($this->data);

        unset($this->collection['badger']);

        $this->assertFalse(isset($this->collection['badger']));
    }

    public function testUnsetByMagic()
    {
        $this->collection = new ArrayObject($this->data);

        unset($this->collection->badger);

        $this->assertFalse(isset($this->collection->badger));
    }

    public function testGetIterator()
    {
        $this->collection = new ArrayObject($this->data);

        foreach ($this->collection as $key => $value) {
            $this->assertTrue($key === 'badger');
            break;
        }
    }

    public function testSerialize()
    {
        $this->collection = new ArrayObject($this->data);
        $serialized = serialize($this->collection);
    }
}
