<?php

namespace Winegard\AmazonAlexa\Request\Request\AlexaSkillEvent;

use Winegard\AmazonAlexa\Helper\PropertyHelper;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class SkillAccountLinkedBody
{
    /**
     * @var string|null
     */
    public $accessToken;

    /**
     * @param array $amazonRequest
     *
     * @return SkillAccountLinkedBody
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $body = new self();

        $body->accessToken = PropertyHelper::checkNullValueString($amazonRequest, 'accessToken');

        return $body;
    }
}
