<?php

namespace Domain\Temperature\Actions;

use App\Http\Resources\TemperatureResource;
use App\Models\User;
use Domain\Temperature\Models\Temperature;
use Exception;
use Illuminate\Support\Facades\DB;
use Domain\Temperature\DataTransferObjects\TemperatureFormData;

class CreateTemperatureAction
{
    /**
     * Store temperature action.
     *
     * @param TemperatureFormData $temperatureFormData
     *
     * @return TemperatureResource
     *
     * @throws Exception
     */
    public function __invoke(TemperatureFormData $temperatureFormData): TemperatureResource
    {
        try {
            DB::beginTransaction();

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.openweathermap.org/data/2.5/onecall?lat=$temperatureFormData->latitude&lon=$temperatureFormData->longitude&exclude=hourly,daily&appid=8dc9ba99c4e5fe28f4dc20edbc1848c0");
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            $result = json_decode($response);

            $fahrenheit=9/5*($result->current->temp-273.15)+32;
            $celsius=$result->current->temp-273.15;

            $user = User::where('email', '=', $temperatureFormData->email)->first();

            /** @var Temperature $temperature */
            $temperature = Temperature::create([
                'user_id' => $user->id,
                'city_id' => $temperatureFormData->cityId,
                'celsius' => round($celsius, 2),
                'fahrenheit' => round($fahrenheit, 2),
            ]);

            DB::commit();

            return new TemperatureResource($temperature);
        } catch (Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
