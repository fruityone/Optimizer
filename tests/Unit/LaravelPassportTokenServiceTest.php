<?php

namespace Tests\Unit;

use App\Http\Services\LaravelPassportTokenService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
class LaravelPassportTokenServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testTokenResponse()
    {
        // Mock the GuzzleHttp client
        $client = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Define the expected response
        $responseBody = ['foo' => 'bar'];
        $responseStatus = 200;
        $expectedResponse = new \GuzzleHttp\Psr7\Response($responseStatus, [], json_encode($responseBody));
        $client->expects($this->once())
            ->method('get')
            ->with(
                $this->equalTo(route('user')),
                $this->equalTo([
                    'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer token123',
                    ]
                ])
            )
            ->willReturn($expectedResponse);

        // Call the method under test
        $service = new LaravelPassportTokenService($client);
        $response = $service->tokenResponse('token123');

        // Assert the response
        $this->assertEquals($expectedResponse, $response);
    }

    public function testTokenResponseUnauthorized()
    {
        // Mock the GuzzleHttp client to throw a ClientException with a 401 response
        $client = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('get')
            ->willThrowException(new ClientException('Unauthorized', new \GuzzleHttp\Psr7\Request('GET', 'test'), new \GuzzleHttp\Psr7\Response(401)));

        // Call the method under test
        $service = new LaravelPassportTokenService($client);
        $response = $service->tokenResponse('invalidtoken');

        // Assert the response
        $expectedResponse = response()->json([
            'error' => 'Unauthorized',
            'message' => 'You are not authorized to access this resource.'
        ], 401);
        $this->assertEquals($expectedResponse, $response);
    }
}
