<?php

namespace App\Services\Search\Filters;

class GaragesFilter extends ExactValueFilter
{
    public function __construct()
    {
        parent::__construct('garages');
    }
}
