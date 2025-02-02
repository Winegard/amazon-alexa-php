<?php

namespace Winegard\AmazonAlexa\Test\Response\Directives;

use Winegard\AmazonAlexa\Response\Directives\GadgetController\Animation;
use Winegard\AmazonAlexa\Response\Directives\GadgetController\Parameters;
use Winegard\AmazonAlexa\Response\Directives\GadgetController\Sequence;
use Winegard\AmazonAlexa\Response\Directives\GadgetController\SetLightDirective;
use PHPUnit\Framework\TestCase;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class GadgetControllerTest extends TestCase
{
    public function testSetLightDirective()
    {
        $sequence   = Sequence::create(100, 'FF0099');
        $animations = Animation::create([$sequence], 10, ['1']);
        $parameters = Parameters::create([$animations], Parameters::TRIGGER_EVENT_BUTTON_DOWN, 10);

        $sl = SetLightDirective::create(['gadgetId1', 'gadgetId2'], $parameters);
        $this->assertSame('GadgetController.SetLight', $sl->type);
        $this->assertSame(1, $sl->version);
        $this->assertSame(100, $sl->parameters->animations[0]->sequence[0]->durationMs);
    }
}
