<?php

namespace Winegard\AmazonAlexa\Request\Request\System;

use Winegard\AmazonAlexa\Helper\PropertyHelper;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class Cause
{
    /**
     * @var string|null
     */
    public $requestId;

    /**
     * @param array $amazonRequest
     *
     * @return Cause
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $cause = new self();

        $cause->requestId = PropertyHelper::checkNullValueString($amazonRequest, 'requestId');

        return $cause;
    }
}
