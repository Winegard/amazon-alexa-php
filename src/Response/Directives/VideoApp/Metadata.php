<?php

namespace Winegard\AmazonAlexa\Response\Directives\VideoApp;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class Metadata
{
    /**
     * @var string|null
     */
    public $title;

    /**
     * @var string|null
     */
    public $subtitle;

    /**
     * @param string|null $title
     * @param string|null $subtitle
     *
     * @return Metadata
     */
    public static function create(string $title = null, string $subtitle = null): self
    {
        $metadata = new self();

        $metadata->title    = $title;
        $metadata->subtitle = $subtitle;

        return $metadata;
    }
}
