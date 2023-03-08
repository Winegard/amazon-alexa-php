<?php

namespace Winegard\AmazonAlexa\Test\Response;

use Winegard\AmazonAlexa\Response\Response;
use PHPUnit\Framework\TestCase;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class ResponseTest extends TestCase
{
    public function testEmptyResponse()
    {
        $response = new Response();
        $this->assertSame('{"version":"1.0","sessionAttributes":[],"response":{}}', json_encode($response));
    }
}
