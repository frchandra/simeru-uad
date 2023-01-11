<?php

namespace App\Http\Repository;

use App\Models\SubClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\QueryBuilder\QueryBuilder;

class SubClassRepository{
    /**
     * Get all SubClasses data
     *
     * @return Collection
     */
    public function getAll(){
        return QueryBuilder::for(SubClass::class)->allowedFilters(['lecturer_id','name'])->get();
    }

    /**
     * Create new lecturer data
     *
     * @param array $newLecturer
     * @return Model|SubClass
     */
    public function createNew($newSubClass){
        return SubClass::create($newSubClass);
    }

}
