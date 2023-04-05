<?php

namespace Winegard\AmazonAlexa\Request\Request;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
abstract class AbstractRequest
{
    /**
     * @var string
     */
    public $type;

    /**
     * @var \DateTime
     */
    public $timestamp;

    /**
     * @param array $amazonRequest
     *
     * @return AbstractRequest
     */
    abstract public static function fromAmazonRequest(array $amazonRequest): self;

    /**
     * @return bool
     */
    public function validateTimestamp(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function validateSignature(): bool
    {
        return true;
    }
}
