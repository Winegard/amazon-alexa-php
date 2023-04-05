<?php

namespace Winegard\AmazonAlexa\Request\Request\System;

use Winegard\AmazonAlexa\Helper\PropertyHelper;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class Status
{
    /**
     * @var string|null
     */
    public $code;

    /**
     * @var string|null
     */
    public $message;

    /**
     * @param array $amazonRequest
     *
     * @return Status
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $status = new self();

        $status->code    = PropertyHelper::checkNullValueString($amazonRequest, 'code');
        $status->message = PropertyHelper::checkNullValueString($amazonRequest, 'message');

        return $status;
    }
}
