<?php

namespace Winegard\AmazonAlexa\Request\Request\GameEngine;

use Winegard\AmazonAlexa\Request\Request\AbstractRequest;
use Winegard\AmazonAlexa\Request\Request\GameEngine\Event\Event;
use Winegard\AmazonAlexa\Request\Request\Standard\StandardRequest;

/**
 * @author Fabian Graßl <fabian.grassl@db-n.com>
 */
class InputHandlerEvent extends StandardRequest
{
    const TYPE = 'GameEngine.InputHandlerEvent';

    /**
     * @var string
     */
    public $originatingRequestId;

    /**
     * @var Event[]
     */
    public $events = [];

    /**
     * @inheritdoc
     */
    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $request = new self();

        $request->type                 = self::TYPE;
        $request->originatingRequestId = $amazonRequest['originatingRequestId'];
        foreach ($amazonRequest['events'] as $event) {
            $request->events[] = Event::fromAmazonRequest($event);
        }

        $request->setRequestData($amazonRequest);

        return $request;
    }
}
