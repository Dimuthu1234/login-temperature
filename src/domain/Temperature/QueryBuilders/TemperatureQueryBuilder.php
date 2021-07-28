<?php

namespace Domain\Temperature\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

/**
 * @template T of Post
 * @extends Builder<T>
 */
class TemperatureQueryBuilder extends Builder
{
    /**
     * Query filter for temperatures.
     *
     * @param $request
     *
     * @return $this
     */
    public function filters($request): self
    {
        return $this->with('user')
            ->when(
                $request->filterBy == "chronological",
                fn ($query) => $query->orderBy('created_at', 'desc')
            )->when(
                $request->filterBy == "hottestfirst",
                fn ($query) => $query->orderBy('celsius', 'desc')
            );
    }
}
