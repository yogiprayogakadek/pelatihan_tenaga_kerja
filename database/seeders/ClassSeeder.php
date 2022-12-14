<?php

namespace Database\Seeders;

use App\Models\TrainingClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TrainingClass::create([
            'name' => 'Bartender',
            'Description' => 'Bartender',
            'Category' => 'Bar Class'
        ]);
    }
}
