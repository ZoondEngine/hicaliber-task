<?php

namespace App\Services\Search;

use App\Services\Search\Filters\BaseFilter;
use App\Services\Search\Filters\BathroomsFilter;
use App\Services\Search\Filters\BedroomsFilter;
use App\Services\Search\Filters\GaragesFilter;
use App\Services\Search\Filters\NameFilter;
use App\Services\Search\Filters\PriceFilter;
use App\Services\Search\Filters\StoreysFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class SearchService
{
    /**
     * @var string Model for searching
     */
    private string $model = '';

    /**
     * @var array Options for searching, contains data or settings
     */
    private array $options = [];

    /**
     * @var array Default filters
     */
    private array $filters = [];

    /**
     * @var array Error data container
     */
    private array $errorContainer = [];

    /**
     * Default constructor
     * @param string $model
     * @param array $options
     */
    public function __construct(string $model, array $options)
    {
        $this->model = $model;
        $this->options = $options;

        $this->errorContainer = [
          'was' => false,
          'message' => ''
        ];
    }

    /**
     * Use default filters for searching
     * @return SearchService
     */
    public function useDefaultFilters(): SearchService
    {
        // rewrite array
        $this->filters = [];
        $this->useFilters([
            NameFilter::class,
            PriceFilter::class,
            BathroomsFilter::class,
            BedroomsFilter::class,
            StoreysFilter::class,
            GaragesFilter::class
        ]);

        return $this;
    }

    /**
     * Apply custom filter
     * @param string $filterClass
     * @return SearchService
     */
    public function useFilter(string $filterClass): SearchService
    {
        $this->filters[] = new $filterClass;
        return $this;
    }

    /**
     * Apply array of custom filters
     * @param array $otherFilters
     * @return SearchService
     */
    public function useFilters(array $otherFilters): SearchService
    {
        foreach($otherFilters as $filter) {
            $this->useFilter($filter);
        }

        return $this;
    }

    /**
     * Search the data
     * @return Collection
     */
    public function search(): Collection
    {
        $data = null;

        try {
            $builder = $this->model::query();

            foreach($this->filters as $filter) {
                if($filter->shouldFilter($this->options)) {
                    $builder = $filter->filter($builder, $this->options);
                }
            }

            $data = $builder->get();
        }
        catch (\Exception $e) {
            $this->error('Error `' . $e->getMessage() . '` was occurred while searching for: ' . $this->model);
        }

        return collect([
            'data' => $data,
            'error' => $this->errorContainer
        ]);
    }

    /**
     * @param string $message
     * @return void
     */
    private function error(string $message): void
    {
        $this->errorContainer['was'] = true;
        $this->errorContainer['message'] = $message;

        Log::error($message);
    }
}
