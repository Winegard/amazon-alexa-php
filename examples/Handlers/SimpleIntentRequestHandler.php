<?php

use Winegard\AmazonAlexa\Helper\ResponseHelper;
use Winegard\AmazonAlexa\Request\Request;
use Winegard\AmazonAlexa\Request\Request\Standard\IntentRequest;
use Winegard\AmazonAlexa\RequestHandler\AbstractRequestHandler;
use Winegard\AmazonAlexa\Response\Response;

/**
 * Just a simple example request handler.
 *
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class SimpleIntentRequestHandler extends AbstractRequestHandler
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
        return $this->responseHelper->respond('Success :)');
    }
}