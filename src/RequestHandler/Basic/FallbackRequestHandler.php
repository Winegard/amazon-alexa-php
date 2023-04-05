<?php

namespace Winegard\AmazonAlexa\RequestHandler\Basic;

use Winegard\AmazonAlexa\Helper\ResponseHelper;
use Winegard\AmazonAlexa\Request\Request;
use Winegard\AmazonAlexa\Request\Request\Standard\IntentRequest;
use Winegard\AmazonAlexa\RequestHandler\AbstractRequestHandler;
use Winegard\AmazonAlexa\Response\Response;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class FallbackRequestHandler extends AbstractRequestHandler
{
    /**
     * @var ResponseHelper
     */
    private $responseHelper;

    /**
     * @var string
     */
    private $output;

    /**
     * @param ResponseHelper $responseHelper
     * @param string         $output
     * @param array          $supportedApplicationIds
     */
    public function __construct(ResponseHelper $responseHelper, string $output, array $supportedApplicationIds)
    {
        $this->responseHelper          = $responseHelper;
        $this->output                  = $output;
        $this->supportedApplicationIds = $supportedApplicationIds;
    }

    /**
     * @inheritdoc
     */
    public function supportsRequest(Request $request): bool
    {
        // support amazon fallback request, amazon default intents are prefixed with "AMAZON."
        return $request->request instanceof IntentRequest && 'AMAZON.FallbackIntent' === $request->request->intent->name;
    }

    /**
     * @inheritdoc
     */
    public function handleRequest(Request $request): Response
    {
        return $this->responseHelper->respond($this->output, true);
    }
}
