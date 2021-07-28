<?php


namespace Tests\App\Http\Controllers\API;

use App\Models\User;
use Domain\Temperature\Actions\CreateTemperatureAction;
use Domain\Temperature\DataTransferObjects\TemperatureFormData;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TemperatureControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function can_store_temperature()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->mock(CreateTemperatureAction::class)
            ->expects('__invoke')
            ->with(TemperatureFormData::class);

        $response = $this->postJson(route('temperature.store'), [
            'user_id' => $user->id,
            'city_id' => 1,
            'celsius' => round($this->faker->randomFloat(), 2),
            'fahrenheit' => round($this->faker->randomFloat(), 2),
        ]);

        $response->assertOk();
    }
}
