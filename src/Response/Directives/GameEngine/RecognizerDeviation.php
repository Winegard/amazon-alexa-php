<?php

namespace Winegard\AmazonAlexa\Response\Directives\GameEngine;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class RecognizerDeviation extends Recognizer
{
    const TYPE = 'deviation';

    /**
     * @var string|null
     */
    public $recognizer;

    /**
     * @param string $recognizer
     *
     * @return RecognizerDeviation
     */
    public static function create(string $recognizer): self
    {
        $recognizerDeviation = new self();

        $recognizerDeviation->type       = self::TYPE;
        $recognizerDeviation->recognizer = $recognizer;

        return $recognizerDeviation;
    }
}
