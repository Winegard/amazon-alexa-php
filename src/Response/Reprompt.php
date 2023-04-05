<?php

namespace Winegard\AmazonAlexa\Response;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class Reprompt
{
    /**
     * @var OutputSpeech
     */
    public $outputSpeech;

    /**
     * Construct reprompt with needed output speech.
     *
     * @param OutputSpeech $outputSpeech
     */
    public function __construct(OutputSpeech $outputSpeech)
    {
        $this->outputSpeech = $outputSpeech;
    }
}
