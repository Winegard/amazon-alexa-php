<?php

namespace Winegard\AmazonAlexa\Response\Directives\Dialog;

use Winegard\AmazonAlexa\Intent\Intent;
use Winegard\AmazonAlexa\Response\Directives\Directive;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class ElicitSlotDirective extends Directive
{
    const TYPE = 'Dialog.ElicitSlot';

    /**
     * @var string|null
     */
    public $slotToElicit;

    /**
     * @var Intent|null
     */
    public $updatedIntent;

    /**
     * @param string      $slotToElicit
     * @param Intent|null $intent
     *
     * @return ElicitSlotDirective
     */
    public static function create(string $slotToElicit, Intent $intent = null): self
    {
        $elicitSlotDirective = new self();

        $elicitSlotDirective->type          = self::TYPE;
        $elicitSlotDirective->slotToElicit  = $slotToElicit;
        $elicitSlotDirective->updatedIntent = $intent;

        return $elicitSlotDirective;
    }
}
