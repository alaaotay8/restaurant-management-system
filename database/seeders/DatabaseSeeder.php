<?php
// database/seeders/RestoreOldDataSeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestoreOldDataSeeder extends Seeder
{
    public function run()
    {
        DB::table('your_table')->insert([
            ['column1' => 'value1', 'column2' => 'value2'],
            // Add more data as needed
        ]);
    }
}
