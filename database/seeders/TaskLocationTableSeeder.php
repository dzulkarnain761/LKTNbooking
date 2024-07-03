<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskLocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('task_locations')->insert([
            ['district_code' => 2, 'district' => 'KOTA BHARU', 'state' => 'KELANTAN'],
            ['district_code' => 3, 'district' => 'MACHANG', 'state' => 'KELANTAN'],
            ['district_code' => 4, 'district' => 'PASIR MAS', 'state' => 'KELANTAN'],
            ['district_code' => 5, 'district' => 'PASIR PUTEH', 'state' => 'KELANTAN'],
            ['district_code' => 6, 'district' => 'TANAH MERAH', 'state' => 'KELANTAN'],
            ['district_code' => 7, 'district' => 'TUMPAT', 'state' => 'KELANTAN'],
            ['district_code' => 8, 'district' => 'GUA MUSANG', 'state' => 'KELANTAN'],
            ['district_code' => 9, 'district' => 'KUALA KRAI', 'state' => 'KELANTAN'],
            ['district_code' => 10, 'district' => 'JELI', 'state' => 'KELANTAN'],
            ['district_code' => 1, 'district' => 'BACHOK', 'state' => 'KELANTAN'],
            ['district_code' => 1, 'district' => 'BESUT', 'state' => 'TERENGGANU'],
            ['district_code' => 7, 'district' => 'SETIU', 'state' => 'TERENGGANU'],
            ['district_code' => 6, 'district' => 'MARANG', 'state' => 'TERENGGANU'],
            ['district_code' => 0, 'district' => 'KUALA NERUS', 'state' => 'TERENGGANU'],
            ['district_code' => 5, 'district' => 'HULU TERENGGANU', 'state' => 'TERENGGANU'],
            ['district_code' => 4, 'district' => 'KUALA TERENGGANU', 'state' => 'TERENGGANU'],
            ['district_code' => 3, 'district' => 'KEMAMAN', 'state' => 'TERENGGANU'],
            ['district_code' => 2, 'district' => 'DUNGUN', 'state' => 'TERENGGANU'],
        ]);
    }
}
