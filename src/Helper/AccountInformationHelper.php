<?php

namespace Winegard\AmazonAlexa\Helper;

use GuzzleHttp\Client;
use Winegard\AmazonAlexa\Exception\AccountsApiCallException;
use Winegard\AmazonAlexa\Exception\MissingRequestDataException;
use Winegard\AmazonAlexa\Request\Device\DeviceAddressInformation;
use Winegard\AmazonAlexa\Request\Request;

/**
 * This helper class can call the amazon api to get address information.
 * For more details @see https=>//developer.amazon.com/de/docs/custom-skills/device-address-api.html.
 *
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
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
     * @return null|string
     */
    public function getEmailAddress(Request $request): ?string
    {
        if (!isset($request->context->system->apiAccessToken, $request->context->system->apiEndpoint)) {
            throw new MissingRequestDataException();
        }

        $token    = $request->context->system->apiAccessToken;
        $endpoint = $request->context->system->apiEndpoint;

        $url = sprintf('%s/v2/accounts/~current/settings/Profile.email', $endpoint);

        return $this->apiCall($url, $token);
    }

    /**
     * @param Request $request
     *
     * @throws MissingRequestDataException
     *
     * @return null|string
     */
    public function getGivenName(Request $request): ?string
    {
        if (!isset($request->context->system->apiAccessToken, $request->context->system->apiEndpoint)) {
            throw new MissingRequestDataException();
        }

        $token    = $request->context->system->apiAccessToken;
        $endpoint = $request->context->system->apiEndpoint;

        $url = sprintf('%s/v2/accounts/~current/settings/Profile.givenName', $endpoint);

        return $this->apiCall($url, $token);
    }

    /**
     * @param string $url
     * @param string $token
     *
     * @throws AccountsApiCallException
     *
     * @return null|string
     */
    private function apiCall(string $url, string $token): ?string
    {
        $response = $this->client->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
                'Accept'        => 'application/json',
            ],
        ]);

        /*
         * Api Call response codes:
         * 200 OK                   Successfully got the address associated with this deviceId.
         * 204 No Content           The query did not return any results.
         * 403 Forbidden            The authentication token is invalid or doesn’t have access to the resource.
         * 405 Method Not Allowed   The method is not supported.
         * 429 Too Many Requests    The skill has been throttled due to an excessive number of requests.
         * 500 Internal Error       An unexpected error occurred.
         */
        if (200 !== $response->getStatusCode()) {
            throw new AccountsApiCallException(sprintf('Error in api call (status code:"%s")', $response->getStatusCode()));
        }

        return $response->getBody()->getContents();
    }
}
