<?php

namespace Winegard\AmazonAlexa\Test\RequestHandler;

use Winegard\AmazonAlexa\Exception\MissingRequestHandlerException;
use Winegard\AmazonAlexa\Helper\ResponseHelper;
use Winegard\AmazonAlexa\Request\Application;
use Winegard\AmazonAlexa\Request\Context;
use Winegard\AmazonAlexa\Request\Request;
use Winegard\AmazonAlexa\Request\Request\Standard\IntentRequest;
use Winegard\AmazonAlexa\Request\System;
use Winegard\AmazonAlexa\RequestHandler\AbstractRequestHandler;
use Winegard\AmazonAlexa\RequestHandler\RequestHandlerRegistry;
use Winegard\AmazonAlexa\Response\Response;
use PHPUnit\Framework\TestCase;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class RequestHandlerRegistryTest extends TestCase
{
    public function testSimpleRequest()
    {
        $responseHelper = new ResponseHelper();
        $handler        = new SimpleTestRequestHandler($responseHelper);
        $registry       = new RequestHandlerRegistry();

        $intentRequest              = new IntentRequest();
        $intentRequest->type        = 'test';
        $application                = new Application();
        $application->applicationId = 'my_amazon_skill_id';
        $system                     = new System();
        $system->application        = $application;
        $context                    = new Context();
        $context->system            = $system;
        $request                    = new Request();
        $request->request           = $intentRequest;
        $request->context           = $context;

        $registry->addHandler($handler);
        $registry->getSupportingHandler($request);

        $this->assertSame($handler, $registry->getSupportingHandler($request));
    }

    public function testSimpleRequestAddHandlerByConstructor()
    {
        $responseHelper = new ResponseHelper();
        $handler        = new SimpleTestRequestHandler($responseHelper);
        $registry       = new RequestHandlerRegistry([$handler]);

        $intentRequest              = new IntentRequest();
        $intentRequest->type        = 'test';
        $application                = new Application();
        $application->applicationId = 'my_amazon_skill_id';
        $system                     = new System();
        $system->application        = $application;
        $context                    = new Context();
        $context->system            = $system;
        $request                    = new Request();
        $request->request           = $intentRequest;
        $request->context           = $context;

        $registry->getSupportingHandler($request);

        $this->assertSame($handler, $registry->getSupportingHandler($request));
    }

    public function testMissingHandlerRequest()
    {
        $registry = new RequestHandlerRegistry();

        $intentRequest              = new IntentRequest();
        $intentRequest->type        = 'test';
        $application                = new Application();
        $application->applicationId = 'my_amazon_skill_id';
        $system                     = new System();
        $system->application        = $application;
        $context                    = new Context();
        $context->system            = $system;
        $request                    = new Request();
        $request->request           = $intentRequest;
        $request->context           = $context;

        $this->expectException(MissingRequestHandlerException::class);
        $registry->getSupportingHandler($request);
    }
}

/**
 * Just a simple test example.
 *
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class SimpleTestRequestHandler extends AbstractRequestHandler
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
     * @inheritdoc
     */
    public function supportsRequest(Request $request): bool
    {
        // support test requests.
        return 'test' === $request->request->type;
    }

    /**
     * @inheritdoc
     */
    public function handleRequest(Request $request): Response
    {
        return $this->responseHelper->respond('Success :)');
    }
}
