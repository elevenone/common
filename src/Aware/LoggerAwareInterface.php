<?php

namespace EmbarkNow\Aware;

use Psr\Log\LoggerInterface;

/**
 * Provide functionality to set and get a Logger instance
 */
interface LoggerAwareInterface
{
    /**
     * Set a Logger instance
     *
     * @param Logger $logger
     *  The Logger instance
     */
    public function setLogger(LoggerInterface $logger);

    /**
     * Get a Logger instance
     *
     * @return Logger
     *  A Logger instance
     */
    public function getLogger();
}
