<?php

use App\Pattern;
use Illuminate\Database\Seeder;

class PatternsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('patterns')->truncate();

        $patternRecords = [
            ['description' => 'Plain', 'status' => 1],
            ['description' => 'Checked', 'status' => 1],
            ['description' => 'Printed', 'status' => 1],
            ['description' => 'Self', 'status' => 1],
            ['description' => 'Solid', 'status' => 1],
            ['description' => 'Others', 'status' => 1],
            ['description' => 'Not Applicable', 'status' => 1],
        ];

        foreach ($patternRecords as $key => $record)
        {
            Pattern::create($record);
        }
    }
}
