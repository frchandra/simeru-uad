<?php

namespace App\Http\Services;

use App\Http\Repository\SubClassRepository;
use Illuminate\Validation\ValidationException;

class SubClassServices{
    private SubClassRepository $subClassRepository;

    public function __construct(SubClassRepository $subClassRepository){
        $this->subClassRepository = $subClassRepository;
    }

    /**
     * Get all SubClasses data
     *
     * @return array
     */
    public function getAll(){
        return $this->subClassRepository->getAll()->toArray();
    }

    /**
     * Create new subclass entry
     *
     * @param array $newSubClass
     * @return \App\Models\SubClass|\Illuminate\Database\Eloquent\Model
     */
    public function createNew($name, $quota, $credit, $semester){
        return $this->subClassRepository->createNew($name, $quota, $credit, $semester);
    }

    /**
     * Show one SubClass data
     *
     * @param int
     * @return array
     * @throws ValidationException
     */
    public function show($id){
        $subClass =  $this->subClassRepository->show($id);
        if($subClass->count()<1){
            throw  ValidationException::withMessages(['message' => 'cannot find the corresponding sub class for the given sub_class_id']);
        }
        return $subClass->toArray();
    }

    /**
     * Update subclass data
     *
     * @param int $id
     * @param array $newData
     * @return int
     * @throws ValidationException
     */
    public function update($id, $newData){
        $affected = $this->subClassRepository->update($id, $newData);
        if($affected < 1) {
            throw ValidationException::withMessages(['message' => 'cannot find the corresponding subclass for the given sub_class_id']);
        }
        return $affected;
    }

    /**
     * Update subclass data
     *
     * @param int $id
     * @return int
     * @throws ValidationException
     */
    public function destroy($id){
        $affected = $this->subClassRepository->destroy($id);
        if($affected < 1){
            throw ValidationException::withMessages(['message' => 'cannot find the corresponding subclass for the given sub_class_id']);
        }
        return $affected;
    }
}
