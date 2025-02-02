<?php

namespace Winegard\AmazonAlexa\Request\Request\AlexaSkillEvent;

use Winegard\AmazonAlexa\Helper\PropertyHelper;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
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
