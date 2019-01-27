<?php
namespace App\App\Domain\Traits;
use Illuminate\Database\Eloquent\Builder;

/**
 * Children for self-referencal relationships.
 */
trait HasChildren
{
    public function scopeParents(Builder $builder)
    {

        $builder->whereNull('parent_id');
    }
    public function children()
    {
        return $this->hasMany(static::class,'parent_id','id');
    }
}
