<?php

namespace Winegard\AmazonAlexa\Request;

use Winegard\AmazonAlexa\Helper\PropertyHelper;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class Device
{
    /**
     * @var string|null
     */
    public $deviceId;

    /**
     * @var array
     */
    public $supportedInterfaces;

    /**
     * @var string|null
     */
    public $accessToken;

    /**
     * @param array $amazonRequest
     *
     * @return Device
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $device = new self();

        $device->deviceId            = PropertyHelper::checkNullValueString($amazonRequest, 'deviceId');
        $device->supportedInterfaces = isset($amazonRequest['supportedInterfaces']) ? (array) $amazonRequest['supportedInterfaces'] : [];
        $device->accessToken         = PropertyHelper::checkNullValueString($amazonRequest, 'accessToken');

        return $device;
    }
}
