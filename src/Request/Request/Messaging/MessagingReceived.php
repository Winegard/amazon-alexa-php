<?php

namespace Winegard\AmazonAlexa\Request\Messaging;

use Winegard\AmazonAlexa\Request\Request\AbstractRequest;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class MessagingReceived extends AbstractRequest
{
    const DIALOG_STATE_STARTED     = 'STARTED';
    const DIALOG_STATE_IN_PROGRESS = 'IN_PROGRESS';
    const DIALOG_STATE_COMPLETED   = 'COMPLETED';

    const TYPE = 'Messaging.MessageReceived';

    /**
     * @var string|null
     */
    public $dialogState;

    /**
     * @var Intent|null
     */
    public $intent;

    /**
     * @inheritdoc
     */
    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $request = new static();

        $request->type        = static::TYPE;
        $request->dialogState = PropertyHelper::checkNullValueString($amazonRequest, 'dialogState');
        $request->intent      = Intent::fromAmazonRequest($amazonRequest['intent']);
        $request->setRequestData($amazonRequest);

        return $request;
    }
}
