<?php

namespace App\Services\Search\Filters;

class BathroomsFilter extends ExactValueFilter
{
    public function __construct()
    {
        parent::__construct('bathrooms');
    }
}
