<?php

namespace App\Services\Search\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class PriceFilter extends BaseFilter
{
    public function __construct()
    {
        $this->useCustom(function(Builder $builder, array $options) {
            return $builder->whereBetween('price', [
                $options['price'][0],
                $options['price'][1]
            ]);
        });
    }

    public function shouldFilter(array $options): bool
    {
        return Arr::has($options, 'price')
            && $options['price'] !== null;
    }
}
