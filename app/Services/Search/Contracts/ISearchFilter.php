<?php

namespace App\Services\Search\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface ISearchFilter
{
    /**
     * Filtering the results
     * @param Builder $builder
     * @param array $options
     * @return Builder
     */
    public function filter(Builder $builder, array $options): Builder;

    /**
     * Indicates if filter required from service
     * @param array $options
     * @return bool
     */
    public function shouldFilter(array $options): bool;
}
