<?php

namespace Winegard\AmazonAlexa\Request\Request\System;

use Winegard\AmazonAlexa\Request\Request\AbstractRequest;
use Winegard\AmazonAlexa\Request\Request\Error;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class ExceptionEncounteredRequest extends SystemRequest
{
    const TYPE = 'System.ExceptionEncountered';

    /**
     * @var Error|null
     */
    public $error;

    /**
     * @var Cause|null
     */
    public $cause;

    /**
     * @inheritdoc
     */
    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $request = new self();

        $request->type  = self::TYPE;
        $request->error = isset($amazonRequest['error']) ? Error::fromAmazonRequest($amazonRequest['error']) : null;
        $request->cause = isset($amazonRequest['cause']) ? Cause::fromAmazonRequest($amazonRequest['cause']) : null;
        $request->setRequestData($amazonRequest);

        return $request;
    }
}
