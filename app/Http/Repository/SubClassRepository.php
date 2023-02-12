<?php

namespace App\Http\Repository;

use App\Models\SubClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use function Symfony\Component\String\s;

class SubClassRepository{
    /**
     * Get all SubClasses data
     *
     * @return Collection
     */
    public function getAll(){
        return QueryBuilder::for(SubClass::class)->allowedFilters(['sub_class_id','name','quota','credit','semester'])->get();
    }

    /**
     * Create new subclass data
     *
     * @param array $newSubClass
     * @return Model|SubClass
     */
    public function createNew($name, $quota, $credit, $semester){
        return SubClass::create([
            'name' => $name,
            'quota' => $quota,
            'credit' => $credit,
            'semester' => $semester
        ]);
    }

    /**
     * Show one subclass data
     *
     * @param int
     * @return Collection
     */
    public function show($id){
        return SubClass::whereSubClassId($id)->get();
    }

    /**
     * Update subclass data
     *
     * @param int $id
     * @param array $newData
     * @return int
     */
    public function update($id, $newData){
        return SubClass::where('sub_class_id', $id)->update($newData);
    }

    /**
     * Update subclass data
     *
     * @param int $id
     * @return int
     */
    public function destroy($id){
        return SubClass::destroy($id);
    }

}
