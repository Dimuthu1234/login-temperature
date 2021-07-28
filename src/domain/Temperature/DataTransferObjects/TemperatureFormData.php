<?php

namespace Domain\Temperature\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class TemperatureFormData extends DataTransferObject
{
    /**
     * City id of the cities.
     *
     * @var int|null
     */
    public ?int $cityId;

    /**
     * Email of the user.
     *
     * @var string|null
     */
    public ?string $email;

    /**
     * Latitude of the city.
     *
     * @var float|null
     */

    public ?float $latitude;
    /**
     * Longitude of the city.
     *
     * @var float|null
     */
    public ?float $longitude;
}
