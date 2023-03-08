<?php

namespace Winegard\AmazonAlexa\Response\Directives\Dialog\UpdateDynamicEntities;

use Winegard\AmazonAlexa\Response\Directives\Directive;

abstract class UpdateDynamicEntities extends Directive
{
    const TYPE = 'Dialog.UpdateDynamicEntities';

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $updateBehavior;
}
