<?php

namespace App\Services\Search\Filters;

use App\Services\Search\Contracts\ISearchFilter;
use Closure;
use Illuminate\Database\Eloquent\Builder;

abstract class BaseFilter implements ISearchFilter
{
    /**
     * @var string Column for search
     */
    protected string $column = '';

    /**
     * @var string Operator for apply in `where` statement
     */
    protected string $operator = '';

    /**
     * @var string !!Dangerous!! Use it only if you're understood what is this
     */
    protected string $callableStatement = 'where';

    /**
     * @var string Value for search
     */
    protected string $value = '';

    /**
     * @var Closure|null Custom search function
     */
    protected ?Closure $custom = null;

    /**
     * @var Closure|null Used for callback before executing filter
     */
    protected ?Closure $before = null;

    /**
     * Apply custom search function for current filter
     * @param Closure $closure
     * @return $this
     */
    protected function useCustom(Closure $closure): BaseFilter
    {
        $this->custom = $closure;
        return $this;
    }

    /**
     * Apply the before callback
     * @param Closure $closure
     * @return $this
     */
    protected function before(Closure $closure): BaseFilter
    {
        $this->before = $closure;
        return $this;
    }

    /**
     * @param Builder $builder
     * @param array $options
     * @return Builder
     */
    public function filter(Builder $builder, array $options): Builder
    {
        $this->before?->call($this, $options);

        if($this->custom !== null) {
            return $this->custom->call($this, $builder, $options);
        }

        return $builder->{$this->callableStatement}(
            $this->column,
            $this->operator,
            $this->value
        );
    }

    /**
     * @param array $options
     * @return bool
     */
    public abstract function shouldFilter(array $options): bool;
}
