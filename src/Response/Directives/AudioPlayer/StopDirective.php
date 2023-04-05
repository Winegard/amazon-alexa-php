<?php

namespace Winegard\AmazonAlexa\Response\Directives\AudioPlayer;

use Winegard\AmazonAlexa\Response\Directives\Directive;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class StopDirective extends Directive
{
    const TYPE = 'AudioPlayer.Stop';

    /**
     * @return StopDirective
     */
    public static function create(): self
    {
        $stopDirective = new self();

        $stopDirective->type = self::TYPE;

        return $stopDirective;
    }
}
