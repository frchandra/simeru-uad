<?php

namespace App\Http\Repository;

use App\Models\Lecturer;
use Illuminate\Support\Collection;

class LecturerRepository{
    /**
     * Get all lecturers data
     *
     * @return Collection
     */
    public function getAll(){
        return Lecturer::select()->get();
    }
}
