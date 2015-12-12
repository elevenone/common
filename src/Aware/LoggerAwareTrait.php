<?php

namespace EmbarkNow\Aware;

use Psr\Log\LoggerInterface;

/**
 * Provide functionality to set and get a Logger instance
 */
trait LoggerAwareTrait
{
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * Set a Logger instance
     *
     * @param Logger $logger
     *  The Logger instance
     */
    public function setLogger(Logger $logger)
    {
        if (null === $this->logger) {
            $this->logger = $logger;
        }

        return $this;
    }

    /**
     * Get a Logger instance
     *
     * @return Logger
     *  A Logger instance
     */
    public function getLogger()
    {
        return $this->logger;
    }
}
