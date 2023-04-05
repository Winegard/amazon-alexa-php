<?php

namespace Winegard\AmazonAlexa\Request;

use Winegard\AmazonAlexa\Helper\PropertyHelper;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class User
{
    /**
     * @var string|null
     */
    public $userId;

    /**
     * @var UserPermissions|null
     */
    public $permissions;

    /**
     * @var string|null
     */
    public $accessToken;

    /**
     * @param array $amazonRequest
     *
     * @return User
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $user = new self();

        $user->userId      = PropertyHelper::checkNullValueString($amazonRequest, 'userId');
        $user->permissions = isset($amazonRequest['permissions']) ? UserPermissions::fromAmazonRequest($amazonRequest['permissions']) : null;
        $user->accessToken = PropertyHelper::checkNullValueString($amazonRequest, 'accessToken');

        return $user;
    }
}
