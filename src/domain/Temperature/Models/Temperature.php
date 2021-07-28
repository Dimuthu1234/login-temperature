<?php

namespace Domain\Temperature\Models;

use App\Models\User;
use Domain\Temperature\QueryBuilders\TemperatureQueryBuilder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;
use Domain\Temperature\Factories\TemperatureFactory;

class Temperature extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get user for related temperature
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param Builder $query
     *
     * @return TemperatureQueryBuilder
     */
    public function newEloquentBuilder($query): TemperatureQueryBuilder
    {
        return new TemperatureQueryBuilder($query);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected static function newFactory()
    {
        return TemperatureFactory::new();
    }
}
