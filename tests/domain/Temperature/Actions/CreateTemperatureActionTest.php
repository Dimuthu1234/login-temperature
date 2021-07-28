<?php

namespace Tests\Domain\Temperature\Actions;

use App\Models\User;
use Domain\Temperature\Actions\CreateTemperatureAction;
use Domain\Temperature\DataTransferObjects\TemperatureFormData;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTemperatureActionTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test
     *
     * @throws UnknownProperties
     */
    public function it_can_temperature_content_successfully()
    {
        $user = User::factory()->create();

        $temperatureData = new TemperatureFormData(
            cityId: 1,
            email: $user->email,
            latitude: 6.927079,
            longitude: 79.861244,
        );

        app(CreateTemperatureAction::class)($temperatureData);

        $this->assertCount(1, $user->temperatures);
    }
}
