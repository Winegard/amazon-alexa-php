<?php

namespace Winegard\AmazonAlexa\Helper;

use GuzzleHttp\Client;
use Winegard\AmazonAlexa\Exception\DeviceApiCallException;
use Winegard\AmazonAlexa\Exception\MissingRequestDataException;
use Winegard\AmazonAlexa\Request\Device\DeviceAddressInformation;
use Winegard\AmazonAlexa\Request\Request;

/**
 * This helper class can call the amazon api to get address information.
 * For more details @see https=>//developer.amazon.com/de/docs/custom-skills/device-address-api.html.
 *
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class AccountInformationHelper
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client|null $client
     */
    public function __construct(Client $client = null)
    {
        $this->client = $client ?: new Client();
    }

    /**
     * @param Request $request
     *
     * @throws MissingRequestDataException
     *
     * @return DeviceAddressInformation
     */
    public function getEmailAddress(Request $request): ?string
    {
        if (!isset($request->context->system->apiAccessToken, $request->context->system->apiEndpoint)) {
            throw new MissingRequestDataException();
        }

        $token    = $request->context->system->apiAccessToken;
        $endpoint = $request->context->system->apiEndpoint;

        $url = sprintf('%s/v1/accounts/%s/settings/Profile.email', $endpoint, $deviceId);

        return $this->apiCall($url, $token);
    }
}
