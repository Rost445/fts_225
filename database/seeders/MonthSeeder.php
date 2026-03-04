<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;  


class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $months = [
            ['id' => 1,  'name' => 'Січень'],
            ['id' => 2,  'name' => 'Лютий'],
            ['id' => 3,  'name' => 'Березень'],
            ['id' => 4,  'name' => 'Квітень'],
            ['id' => 5,  'name' => 'Травень'],
            ['id' => 6,  'name' => 'Червень'],
            ['id' => 7,  'name' => 'Липень'],
            ['id' => 8,  'name' => 'Серпень'],
            ['id' => 9,  'name' => 'Вересень'],
            ['id' => 10, 'name' => 'Жовтень'],
            ['id' => 11, 'name' => 'Листопад'],
            ['id' => 12, 'name' => 'Грудень'],
        ];

        DB::table('month_names')->insert($months);
    }
}
