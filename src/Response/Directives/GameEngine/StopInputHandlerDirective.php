<?php

namespace Winegard\AmazonAlexa\Response\Directives\GameEngine;

use Winegard\AmazonAlexa\Response\Directives\Directive;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class StopInputHandlerDirective extends Directive
{
    const TYPE = 'GameEngine.StopInputHandler';

    /**
     * @var string|null
     */
    public $originatingRequestId;

    /**
     * @param string $originatingRequestId
     *
     * @return StopInputHandlerDirective
     */
    public static function create(string $originatingRequestId): self
    {
        $setLight = new self();

        $setLight->type                 = self::TYPE;
        $setLight->originatingRequestId = $originatingRequestId;

        return $setLight;
    }
}
