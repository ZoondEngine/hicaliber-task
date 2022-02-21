<?php

namespace App\Services\Search\Filters;

class BedroomsFilter extends ExactValueFilter
{
    public function __construct()
    {
        parent::__construct('bedrooms');
    }
}
