<?php
namespace App\App\Domain\Traits;

use Illuminate\Database\Eloquent\Builder;

trait FetchLatest
{
    public function scopeLatestFirst(Builder $query) {
        return $query->orderBy('created_at', 'desc');
    }
}
