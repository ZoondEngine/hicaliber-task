<?php

namespace App\Services\Search\Filters;

use Illuminate\Support\Arr;

class NameFilter extends BaseFilter
{
    protected string $column = 'name';
    protected string $operator = 'LIKE';

    public function __construct()
    {
        $this->before(function(array $options) {
            $this->value = '%'.$options['name'].'%';
        });
    }

    public function shouldFilter(array $options): bool
    {
        return Arr::has($options, 'name')
            && $options['name'] !== null;
    }
}
