<?php

namespace App\Models;

use App\Services\Search\SearchService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\Pure;

class House extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public static function search($options): Collection
    {
        return (new SearchService(House::class, $options))->useDefaultFilters()->search();
    }
}
