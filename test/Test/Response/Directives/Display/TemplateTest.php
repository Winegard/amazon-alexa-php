<?php

namespace Winegard\AmazonAlexa\Test\Response\Directives\Display;

use ArrayObject;
use Winegard\AmazonAlexa\Response\Directives\Display\Image;
use Winegard\AmazonAlexa\Response\Directives\Display\ListItem;
use Winegard\AmazonAlexa\Response\Directives\Display\Template;
use Winegard\AmazonAlexa\Response\Directives\Display\TextContent;
use PHPUnit\Framework\TestCase;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class TemplateTest extends TestCase
{
    public function testSerializeTypeAndToken()
    {
        $type  = 'BodyTemplate1';
        $token = 'token';

        $template = Template::create($type, $token);

        $this->assertEquals(new ArrayObject([
            'type'       => $type,
            'token'      => $token,
            'backButton' => Template::BACK_BUTTON_MODE_VISIBLE,
        ]), $template->jsonSerialize());
    }

    public function testSerializeAll()
    {
        $type            = 'BodyTemplate1';
        $token           = 'token';
        $backButton      = Template::BACK_BUTTON_MODE_VISIBLE;
        $backgroundImage = 'background image';
        $title           = 'title';
        $textContent     = TextContent::create();
        $image           = Image::create();
        $listItems       = [ListItem::create()];

        $template = Template::create($type, $token, $backButton, $backgroundImage, $title, $textContent, $image, $listItems);

        $this->assertEquals(new ArrayObject([
            'type'            => $type,
            'token'           => $token,
            'backButton'      => $backButton,
            'backgroundImage' => $backgroundImage,
            'title'           => $title,
            'textContent'     => $textContent,
            'image'           => $image,
            'listItems'       => $listItems,
        ]), $template->jsonSerialize());
    }
}
