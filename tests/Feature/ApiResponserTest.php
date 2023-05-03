<?php

namespace Soulaimaneyh\ApiResponser\Tests\Feature;

use Soulaimaneyh\ApiResponser\Tests\BaseTest;
use Soulaimaneyh\ApiResponser\Repositories\ApiRepository;

class ApiResponserTest extends BaseTest
{
    public function testApiResponserShowAll()
    {
        $apiRepository = new ApiRepository();

        $response = $apiRepository->showAll(collect([
            [
                'id' => 1,
                'name' => 'John'
            ],
            [
                'id' => 2,
                'name' => 'Mark'
            ]
        ]), 200);

        // assert status response
        $responseStatusCode = $response->getStatusCode();
        $responseStatusText = $response->statusText();

        $this->assertEquals($responseStatusCode, 200);
        $this->assertEquals($responseStatusText, "OK");

        // assert response json
        $responseJson = $response->getContent();
    
        $this->assertJson($responseJson);
        $responseData = json_decode($responseJson, true);
        $this->assertContains([
            'id' => 1,
            'name' => 'John'
        ], $responseData['data']);
        $this->assertContains([
            'id' => 2,
            'name' => 'Mark'
        ], $responseData['data']);
    }
}
