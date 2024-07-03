<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehiclesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vehicles')->insert([
            ['id' => 1, 'vehicle_type' => 'Backhoe', 'plate_number' => 'BH1234'],
            ['id' => 2, 'vehicle_type' => 'Tracktor', 'plate_number' => 'TR5678'],
            ['id' => 3, 'vehicle_type' => 'Backhoe', 'plate_number' => 'BH9101'],
            ['id' => 4, 'vehicle_type' => 'Tracktor', 'plate_number' => 'TR1121'],
            ['id' => 5, 'vehicle_type' => 'Backhoe', 'plate_number' => 'BH3141'],
            ['id' => 6, 'vehicle_type' => 'Tracktor', 'plate_number' => 'TR5161'],
            ['id' => 7, 'vehicle_type' => 'Backhoe', 'plate_number' => 'BH7181'],
            ['id' => 8, 'vehicle_type' => 'Tracktor', 'plate_number' => 'TR9202'],
            ['id' => 9, 'vehicle_type' => 'Backhoe', 'plate_number' => 'BH1222'],
            ['id' => 10, 'vehicle_type' => 'Tracktor', 'plate_number' => 'TR3242'],
        ]);
    }
}
