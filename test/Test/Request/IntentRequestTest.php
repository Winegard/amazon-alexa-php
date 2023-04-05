<?php

namespace Winegard\AmazonAlexa\Test\Request;

use Winegard\AmazonAlexa\Exception\MissingRequestDataException;
use Winegard\AmazonAlexa\Exception\MissingRequiredHeaderException;
use Winegard\AmazonAlexa\Request\Request;
use Winegard\AmazonAlexa\Request\Request\Standard\IntentRequest;
use PHPUnit\Framework\TestCase;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class IntentRequestTest extends TestCase
{
    public function testMissingRequestData()
    {
        $this->expectException(MissingRequestDataException::class);
        Request::fromAmazonRequest('', '', '');
    }

    public function testMissingRequestHeaders()
    {
        $this->expectException(MissingRequiredHeaderException::class);
        $requestBody = file_get_contents(__DIR__.'/RequestData/intent.json');
        Request::fromAmazonRequest($requestBody, '', '');
    }

    public function testIntentRequest()
    {
        $requestBody = file_get_contents(__DIR__.'/RequestData/intent.json');
        $request     = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(IntentRequest::class, $request->request);
        $this->assertSame('my-application-id', $request->context->system->application->applicationId);
    }

    public function testIntentRequestShouldGetApplicationId()
    {
        $requestBody = file_get_contents(__DIR__.'/RequestData/intent.json');
        $request     = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(IntentRequest::class, $request->request);
        $this->assertSame('applicationId', $request->getApplicationId());
    }

    public function testIntentRequestWithNumericTimestamp()
    {
        $requestBody                         = json_decode(file_get_contents(__DIR__.'/RequestData/intent.json'), true);
        $requestBody['request']['timestamp'] = 65545900;
        $requestBody                         = json_encode($requestBody);
        $request                             = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(IntentRequest::class, $request->request);
        $this->assertSame('my-application-id', $request->context->system->application->applicationId);
    }
}
