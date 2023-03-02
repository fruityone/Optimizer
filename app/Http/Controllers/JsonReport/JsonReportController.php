<?php

namespace App\Http\Controllers\JsonReport;

use App\Http\Controllers\Controller;
use App\Http\Services\JsonEvalService;
use App\Http\Services\LaravelPassportTokenService;
use App\Models\JsonReport;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Psr\Log\InvalidArgumentException;


class JsonReportController extends Controller
{
    /**
     * @var LaravelPassportTokenService
     */
    private $laravelPassportTokenService;
    /**
     * @var
     */
    private $jsonEvalService;

    /**
     * @param LaravelPassportTokenService $laravelPassportTokenService
     * @param JsonEvalService $jsonEvalService
     */
    public function __construct(LaravelPassportTokenService $laravelPassportTokenService,JsonEvalService $jsonEvalService)
    {
        $this->laravelPassportTokenService = $laravelPassportTokenService;
        $this->jsonEvalService = $jsonEvalService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    function save(Request $request)
    {
        $response = $this->laravelPassportTokenService->tokenResponse($request->token);
        if (($response->getStatusCode() == '200')) {
            $data = json_decode($response->getBody()->getContents());
            $json = JsonReport::create(['json_form' => $request->data, 'user_id' => $data->id]);
            $response = [
                'json_id' => $json->id,
                'memory' => memory_get_usage(true),
                'time' => microtime(true) - LARAVEL_START,
            ];
            $json->save();
            return response()->json($response, 201);
        } else {
            return response()->json($response->getData(), 401);
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    function viewUpdate()
    {
        return view('JsonScripts.json-update', ['method' => 'post']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    function update(Request $request)
    {
        $response = $this->laravelPassportTokenService->tokenResponse($request->token);
        if ($response->getStatusCode() == 200) {
            $userId = json_decode($response->getBody()->getContents())->id;
            $jsonReport = JsonReport::findOrFail($request->jsonId);
            if (!$userId == $jsonReport->user_id) {
                return back()->withErrors(['notOwner' => 'Not your report']);
            }
            $data = json_decode($jsonReport->json_form);
            $updatedData = $this->jsonEvalService->updateJsonInstructions($request->instructions,$data);
            $jsonReport->update(['json_form' => $updatedData]);
            $jsonReport->save();
            return response()->json(['jsonReportId'=>$jsonReport->id]);
        } else {
            return response()->json($response->getData(), 401);
        }
    }
}
