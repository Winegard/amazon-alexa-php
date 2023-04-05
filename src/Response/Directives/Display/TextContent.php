<?php

namespace Winegard\AmazonAlexa\Response\Directives\Display;

use Winegard\AmazonAlexa\Helper\SerializeValueMapper;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class TextContent implements \JsonSerializable
{
    use SerializeValueMapper;

    /**
     * @var Text|null
     */
    public $primaryText;

    /**
     * @var Text|null
     */
    public $secondaryText;

    /**
     * @var Text|null
     */
    public $tertiaryText;

    /**
     * @param Text|null $primaryText
     * @param Text|null $secondaryText
     * @param Text|null $tertiaryText
     *
     * @return TextContent
     */
    public static function create($primaryText = null, $secondaryText = null, $tertiaryText = null): self
    {
        $textContent = new self();

        $textContent->primaryText   = $primaryText;
        $textContent->secondaryText = $secondaryText;
        $textContent->tertiaryText  = $tertiaryText;

        return $textContent;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $data = new \ArrayObject();

        $this->valueToArrayIfSet($data, 'primaryText');
        $this->valueToArrayIfSet($data, 'secondaryText');
        $this->valueToArrayIfSet($data, 'tertiaryText');

        return $data;
    }
}
