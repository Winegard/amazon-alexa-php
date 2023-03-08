<?php

namespace Winegard\AmazonAlexa\Test\Response;

use ArrayObject;
use Winegard\AmazonAlexa\Response\Card;
use Winegard\AmazonAlexa\Response\Directives\Display\RenderTemplateDirective;
use Winegard\AmazonAlexa\Response\OutputSpeech;
use Winegard\AmazonAlexa\Response\Reprompt;
use Winegard\AmazonAlexa\Response\ResponseBody;
use PHPUnit\Framework\TestCase;

/**
 * @author Fabian Graßl <fabian.grassl@db-n.com>
 */
class ResponseBodyTest extends TestCase
{
    public function testJsonSerialize()
    {
        $rb = new ResponseBody();
        $this->assertEquals(new ArrayObject(), $rb->jsonSerialize());
        $rb->shouldEndSession = true;
        $this->assertEquals(new ArrayObject(['shouldEndSession' => true]), $rb->jsonSerialize());
        $card             = new Card();
        $rb->card         = $card;
        $os               = new OutputSpeech();
        $rb->outputSpeech = $os;
        $directive        = new RenderTemplateDirective();
        $rb->addDirective($directive);
        $reprompt     = new Reprompt($rb->outputSpeech);
        $rb->reprompt = $reprompt;
        $this->assertEquals(new ArrayObject([
            'outputSpeech'     => $os,
            'card'             => $card,
            'reprompt'         => $reprompt,
            'shouldEndSession' => true,
            'directives'       => [$directive],
        ]), $rb->jsonSerialize());
    }
}
