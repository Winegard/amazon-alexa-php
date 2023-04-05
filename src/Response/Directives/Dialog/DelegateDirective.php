<?php

namespace Winegard\AmazonAlexa\Response\Directives\Dialog;

use Winegard\AmazonAlexa\Intent\Intent;
use Winegard\AmazonAlexa\Response\Directives\Directive;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class DelegateDirective extends Directive
{
    const TYPE = 'Dialog.Delegate';

    /**
     * @var Intent|null
     */
    public $updatedIntent;

    /**
     * @param Intent|null $intent
     *
     * @return DelegateDirective
     */
    public static function create(Intent $intent = null): self
    {
        $delegateDirective = new self();

        $delegateDirective->type          = self::TYPE;
        $delegateDirective->updatedIntent = $intent;

        return $delegateDirective;
    }
}
