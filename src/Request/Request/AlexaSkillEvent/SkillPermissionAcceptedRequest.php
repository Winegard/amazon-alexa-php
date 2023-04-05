<?php

namespace Winegard\AmazonAlexa\Request\Request\AlexaSkillEvent;

use Winegard\AmazonAlexa\Request\Request\AbstractRequest;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class SkillPermissionAcceptedRequest extends AlexaSkillEventRequest
{
    const TYPE = 'AlexaSkillEvent.SkillPermissionAccepted';

    /**
     * @var SkillPermissionBody|null
     */
    public $body;

    /**
     * @inheritdoc
     */
    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $request = new self();

        $request->type = self::TYPE;
        $request->body = isset($amazonRequest['body']) ? SkillPermissionBody::fromAmazonRequest($amazonRequest['body']) : null;
        $request->setRequestData($amazonRequest);

        return $request;
    }
}
