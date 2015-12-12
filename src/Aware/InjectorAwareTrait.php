<?php

namespace EmbarkNow\Aware;

use Auryn\Injector;

/**
 * Provide functionality to set and get an Auryn Injector instance
 */
trait InjectorAwareTrait
{
    /**
     * @var Injector
     */
    protected $injector;

    /**
     * Set an Injector instance
     *
     * @param Injector $injector
     *  The Injector instance
     */
    public function setInjector(Injector $injector)
    {
        if (null === $this->injector) {
            $this->injector = $injector;
        }

        return $this;
    }

    /**
     * Get an Injector instance
     *
     * @return Injector
     *  An Injector instance
     */
    public function getInjector()
    {
        return $this->injector;
    }
}
