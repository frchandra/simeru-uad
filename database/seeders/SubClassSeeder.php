<?php

namespace Database\Seeders;

use App\Models\SubClass;
use Database\Factories\SubClassFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubClassSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        SubClass::factory(30)->create();
    }
}
