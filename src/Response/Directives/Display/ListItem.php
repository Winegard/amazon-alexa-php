<?php

namespace Winegard\AmazonAlexa\Response\Directives\Display;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class ListItem
{
    /**
     * @var string|null
     */
    public $token;

    /**
     * @var Image|null
     */
    public $image;

    /**
     * @var TextContent|null
     */
    public $textContent;

    /**
     * @param string|null      $token
     * @param Image|null       $image
     * @param TextContent|null $textContent
     *
     * @return ListItem
     */
    public static function create($token = null, $image = null, $textContent = null): self
    {
        $listItem = new self();

        $listItem->token       = $token;
        $listItem->image       = $image;
        $listItem->textContent = $textContent;

        return $listItem;
    }
}
