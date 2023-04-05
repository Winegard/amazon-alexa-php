<?php

namespace Winegard\AmazonAlexa\Response\Directives\VideoApp;

use Winegard\AmazonAlexa\Response\Directives\Directive;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class VideoLaunchDirective extends Directive
{
    const TYPE = 'VideoApp.Launch';

    /**
     * @var VideoItem|null
     */
    public $videoItem;

    /**
     * @param VideoItem|null $videoItem
     *
     * @return VideoLaunchDirective
     */
    public static function create(VideoItem $videoItem = null): self
    {
        $videoLaunchDirective = new self();

        $videoLaunchDirective->type      = self::TYPE;
        $videoLaunchDirective->videoItem = $videoItem;

        return $videoLaunchDirective;
    }
}
