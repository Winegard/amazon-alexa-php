<?php

namespace Winegard\AmazonAlexa\Response\Directives\GadgetController;

use Winegard\AmazonAlexa\Response\Directives\Directive;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class SetLightDirective extends Directive
{
    const TYPE = 'GadgetController.SetLight';

    /**
     * @var int|null
     */
    public $version;

    /**
     * @var array
     */
    public $targetGadgets = [];

    /**
     * @var Parameters|null
     */
    public $parameters;

    /**
     * @param array           $targetGadgets
     * @param Parameters|null $parameters
     * @param int             $version
     *
     * @return SetLightDirective
     */
    public static function create(array $targetGadgets = [], Parameters $parameters = null, int $version = 1): self
    {
        $setLight = new self();

        $setLight->type          = self::TYPE;
        $setLight->targetGadgets = $targetGadgets;
        $setLight->parameters    = $parameters;
        $setLight->version       = $version;

        return $setLight;
    }
}
