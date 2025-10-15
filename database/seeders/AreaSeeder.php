<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        DB::table('areas')->delete();
        DB::statement('ALTER TABLE areas AUTO_INCREMENT = 1');

        // Capture current timestamp
        $now = Carbon::now()->format('Y-m-d H:i:s');

        // Insert sample area records
        DB::table('areas')->insert([
            ['code' => 'TGM', 'name' => 'TAGUM',   'created_at' => $now, 'updated_at' => $now],
            ['code' => 'NWCL', 'name' => 'NEW CORILLA',   'created_at' => $now, 'updated_at' => $now],
            ['code' => 'MSY', 'name' => 'MESAOY',    'created_at' => $now, 'updated_at' => $now],
            ['code' => 'CMBGN', 'name' => 'CUAMBOGAN',    'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
