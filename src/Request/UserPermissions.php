<?php

namespace Winegard\AmazonAlexa\Request;

use Winegard\AmazonAlexa\Helper\PropertyHelper;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class UserPermissions
{
    /**
     * @var string|null
     */
    public $consentToken;

    /**
     * @param array $amazonRequest
     *
     * @return UserPermissions
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $userPermissions = new self();

        $userPermissions->consentToken = PropertyHelper::checkNullValueString($amazonRequest, 'consentToken');

        return $userPermissions;
    }
}
