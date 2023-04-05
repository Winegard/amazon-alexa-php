<?php

namespace Winegard\AmazonAlexa\Test\Response;

use Winegard\AmazonAlexa\Response\Response;
use PHPUnit\Framework\TestCase;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class ResponseTest extends TestCase
{
    public function testEmptyResponse()
    {
        $response = new Response();
        $this->assertSame('{"version":"1.0","sessionAttributes":[],"response":{}}', json_encode($response));
    }
}
