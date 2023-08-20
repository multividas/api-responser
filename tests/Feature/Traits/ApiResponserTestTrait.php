<?php

/**
 * (c) 2023 Multividas inc. All rights reserved.
 * Unauthorized use prohibited.
 * Website: https://www.multividas.com
 */

namespace Multividas\ApiResponser\Tests\Feature\Traits;

trait ApiResponserTestTrait
{
    /**
     * @test
     */
    public function testResponseStatusCode()
    {
        $response = $this->getApiResponse();
        $responseStatusCode = $response->getStatusCode();

        $this->assertEquals(200, $responseStatusCode);
    }

    /**
     * @test
     */
    public function testResponseStatusText()
    {
        $response = $this->getApiResponse();
        $responseStatusText = $response->statusText();

        $this->assertEquals('OK', $responseStatusText);
    }

    /**
     * @test
     */
    public function testResponseHeaders()
    {
        $response = $this->getApiResponse();
        $responseHeaders = $response->headers;

        $this->assertEquals('application/json', $responseHeaders->get('Content-Type'));
    }

    /**
     * @test
     */
    public function testResponseJsonContent()
    {
        $response = $this->getApiResponse();
        $responseJson = $response->getContent();

        $this->assertJson($responseJson);
    }

    /**
     * @test
     */
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
