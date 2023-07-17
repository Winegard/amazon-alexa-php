<?php

namespace Winegard\AmazonAlexa\Request\Request\Standard;

use Winegard\AmazonAlexa\Helper\PropertyHelper;
use Winegard\AmazonAlexa\Request\Request\AbstractRequest;
use Winegard\AmazonAlexa\Request\Request\Error;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class SessionEndedRequest extends StandardRequest
{
    const TYPE = 'SessionEndedRequest';

    /**
     * @var string
     */
    public $reason;

    /**
     * @var Error|null
     */
    public $error;

    /**
     * @inheritdoc
     */
    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $request = new self();

        $request->type   = self::TYPE;
        $request->reason = PropertyHelper::checkNullValueString($amazonRequest, 'reason');
        $request->error  = isset($amazonRequest['error']) ? Error::fromAmazonRequest($amazonRequest['error']) : null;
        $request->setRequestData($amazonRequest);

        return $request;
    }
}
