<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use JetBrains\PhpStorm\Pure;

class SearcheablePrice implements Rule
{
    /**
     * @var int Count of element in array
     */
    private int $count = 2;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    #[Pure]
    public function passes($attribute, $value): bool
    {
        if(is_null($value)) {
            return true;
        }

        if(!is_array($value)) {
            return false;
        }

        if(count($value) !== $this->count) {
            return false;
        }

        return $this->isValidEvery($value);
    }

    /**
     * @param array $value
     * @return bool
     */
    private function isValidEvery(array $value): bool
    {
        foreach($value as $one) {
            if(!is_int($one)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Invalid price for search, must be array of 2 numbers or empty!';
    }
}
