<?php

namespace EmbarkNow\Aware;

use Auryn\Injector;

/**
 * Provide functionality to set and get an Injector instance
 */
interface InjectorAwareInterface
{
    /**
     * Set an Injector instance
     *
     * @param Injector $injector
     *  The Injector instance
     */
    public function setInjector(Injector $injector);

    /**
     * Get an Injector instance
     *
     * @return Injector
     *  An Injector instance
     */
    public function getInjector();
}
