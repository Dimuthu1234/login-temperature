<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TemperatureFormRequest;
use App\Models\User;
use Domain\Temperature\Actions\CreateTemperatureAction;
use Domain\Temperature\DataTransferObjects\TemperatureFormData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;

class TemperatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            return response()->json(
                User::find($request->userId)->temperatures()
                ->filters($request)
                ->get(),
                Response::HTTP_OK
            );
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TemperatureFormRequest $temperatureFormRequest
     * @param CreateTemperatureAction $createTemperatureAction
     *
     * @return JsonResponse
     */
    public function store(
        TemperatureFormRequest $temperatureFormRequest,
        CreateTemperatureAction $createTemperatureAction
    ): JsonResponse {
        try {
            return response()->json(
                $createTemperatureAction(
                    new TemperatureFormData(
                        cityId: $temperatureFormRequest->id,
                        email: $temperatureFormRequest->email,
                        latitude: $temperatureFormRequest->lat,
                        longitude: $temperatureFormRequest->lon,
                    )
                ),
                Response::HTTP_CREATED
            );
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
    }
}
