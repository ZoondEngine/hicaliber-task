<?php

namespace App\Services\Search\Filters;

use Illuminate\Support\Arr;

class ExactValueFilter extends BaseFilter
{
    public function __construct(string $column, string $operator = '=')
    {
        $this->column = $column;
        $this->operator = $operator;

        $this->before(function(array $options) {
            $this->value = $options[$this->column];
        });
    }

    public function shouldFilter(array $options): bool
    {
        return Arr::has($options, $this->column)
            && $options[$this->column] !== null;
    }
}
