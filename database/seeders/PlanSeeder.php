<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('plans')->delete();
        DB::statement('ALTER TABLE plans AUTO_INCREMENT = 1');

        DB::table('plans')->insert([
            [
                'name'       => '5MBPS',
                'price'      => 500.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => '10MBPS',
                'price'      => 1000.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => '15MBPS',
                'price'      => 1500.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
