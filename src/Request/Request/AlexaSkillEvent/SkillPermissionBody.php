<?php

namespace Winegard\AmazonAlexa\Request\Request\AlexaSkillEvent;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class SkillPermissionBody
{
    /**
     * @var array
     */
    public $acceptedPermissions;

    /**
     * @param array $amazonRequest
     *
     * @return SkillPermissionBody
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $body = new self();

        $body->acceptedPermissions = [];

        if ($amazonRequest['acceptedPermissions']) {
            foreach ($amazonRequest['acceptedPermissions'] as $permission) {
                $body->acceptedPermissions[] = Permission::fromAmazonRequest($permission);
            }
        }

        return $body;
    }
}
