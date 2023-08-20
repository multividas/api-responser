<?php

/**
 * (c) 2023 Multividas inc. All rights reserved.
 * Unauthorized use prohibited.
 * Website: https://www.multividas.com
 */

namespace Multividas\ApiResponser\Tests\Traits;

trait ApiResponserTestTrait
{
    public function testResponseStatusCode()
    {
        $response = $this->getApiResponse();
        $responseStatusCode = $response->getStatusCode();

        $this->assertEquals(200, $responseStatusCode);
    }

    public function testResponseStatusText()
    {
        $response = $this->getApiResponse();
        $responseStatusText = $response->statusText();

        $this->assertEquals('OK', $responseStatusText);
    }

    public function testResponseHeaders()
    {
        $response = $this->getApiResponse();
        $responseHeaders = $response->headers;

        $this->assertEquals('application/json', $responseHeaders->get('Content-Type'));
    }

    public function testResponseJsonContent()
    {
        $response = $this->getApiResponse();
        $responseJson = $response->getContent();

        $this->assertJson($responseJson);
    }

    public function testResponseJsonStructure()
    {
        $response = $this->getApiResponse();
        $responseJson = $response->getContent();
        
        $responseData = json_decode($responseJson, true);

        $this->assertArrayHasKey('data', $responseData);
        $this->assertArrayHasKey('code', $responseData);
        $this->assertArrayHasKey('meta', $responseData);

        $this->assertCount(2, $responseData['data']);
    }
}
