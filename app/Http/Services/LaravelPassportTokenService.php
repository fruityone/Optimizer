<?php
namespace App\Http\Services;

use Exception;
use GuzzleHttp\Client;

class LaravelPassportTokenService
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client){
        $this->client=$client;
    }

    function tokenResponse($token)
    {
        try {
            $response = $this->client->get(route('user'), [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $token,
                ]
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // Handle the exception
            $response = $e->getResponse();
            if ($response && $response->getStatusCode() === 401) {
                return response()->json([
                    'error' => 'Unauthorized',
                    'message' => 'You are not authorized to access this resource.'
                ], 401);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
            return $response->withStatus(200);
    }
}

?>
