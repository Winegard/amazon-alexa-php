<?php

use Winegard\AmazonAlexa\Helper\ResponseHelper;
use Winegard\AmazonAlexa\Request\Request;
use Winegard\AmazonAlexa\Request\Request\Standard\IntentRequest;
use Winegard\AmazonAlexa\RequestHandler\AbstractRequestHandler;
use Winegard\AmazonAlexa\Response\Card;
use Winegard\AmazonAlexa\Response\Response;

/**
 * Just a example request handler for a card response with ask for permissions.
 *
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class AskForPermissionsConsentCardResponseRequestHandler extends AbstractRequestHandler
{
    /**
     * @var ResponseHelper
     */
    private $responseHelper;

    /**
     * @param ResponseHelper $responseHelper
     */
    public function __construct(ResponseHelper $responseHelper)
    {
        $this->responseHelper          = $responseHelper;
        $this->supportedApplicationIds = ['my_amazon_skill_id'];
    }

    /**
     * {@inheritdoc}
     */
    public function supportsRequest(Request $request): bool
    {
        // support all intent requests, should not be done.
        return $request->request instanceof IntentRequest;
    }

    /**
     * {@inheritdoc}
     */
    public function handleRequest(Request $request): Response
    {
        // here for example try to get full address. DeviceAddressInformationHelper->getAddress($request)
        // when you get a 403 do sth. like the following.

        // create a card to ask the user for full address permissions
        $card = Card::createAskForPermissionsConsent([Card::PERMISSION_FULL_ADDRESS]);
        $this->responseHelper->card($card);

        return $this->responseHelper->getResponse();
    }
}
