<?php

namespace Winegard\AmazonAlexa\Response\Directives\Dialog;

use Winegard\AmazonAlexa\Intent\Intent;
use Winegard\AmazonAlexa\Response\Directives\Directive;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class ConfirmSlotDirective extends Directive
{
    const TYPE = 'Dialog.ConfirmSlot';

    /**
     * @var string|null
     */
    public $slotToConfirm;

    /**
     * @var Intent|null
     */
    public $updatedIntent;

    /**
     * @param string      $slotToConfirm
     * @param Intent|null $intent
     *
     * @return ConfirmSlotDirective
     */
    public static function create(string $slotToConfirm, Intent $intent = null): self
    {
        $confirmSlotDirective = new self();

        $confirmSlotDirective->type          = self::TYPE;
        $confirmSlotDirective->slotToConfirm = $slotToConfirm;
        $confirmSlotDirective->updatedIntent = $intent;

        return $confirmSlotDirective;
    }
}
