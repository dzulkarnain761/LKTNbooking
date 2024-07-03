<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tasks')->insert([
            ['id' => 1, 'task' => 'BC01-BERSIH KAWASAN', 'vehicle_type' => 'Backhoe', 'price' => '40.00'],
            ['id' => 2, 'task' => 'BC02-PERPARITAN', 'vehicle_type' => 'Backhoe', 'price' => '40.00'],
            ['id' => 3, 'task' => 'TR01-PIRING', 'vehicle_type' => 'Tracktor', 'price' => '100.00'],
            ['id' => 4, 'task' => 'TR02-ROTOR I', 'vehicle_type' => 'Tracktor', 'price' => '100.00'],
            ['id' => 5, 'task' => 'TR03-ROTOR II', 'vehicle_type' => 'Tracktor', 'price' => '100.00'],
            ['id' => 6, 'task' => 'TR04-BATAS', 'vehicle_type' => 'Tracktor', 'price' => '100.00'],
        ]);
    }
}
