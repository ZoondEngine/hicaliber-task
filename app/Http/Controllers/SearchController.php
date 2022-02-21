<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\House;

class SearchController extends Controller
{
    /**
     * @param SearchRequest $request
     * @return array
     */
    public function search(SearchRequest $request): array
    {
        return House::search(
            $request->validated()
        )->jsonSerialize();
    }
}
