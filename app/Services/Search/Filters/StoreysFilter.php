<?php

namespace App\Services\Search\Filters;

class StoreysFilter extends ExactValueFilter
{
    public function __construct()
    {
        parent::__construct('storeys');
    }
}
