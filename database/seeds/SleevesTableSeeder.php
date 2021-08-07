<?php

use App\Sleeve;
use Illuminate\Database\Seeder;

class SleevesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('sleeves')->truncate();

        $sleeveRecords = [
            ['description' => 'Full Sleeve', 'status' => 1],
            ['description' => 'Half Sleeve', 'status' => 1],
            ['description' => 'Short Sleeve', 'status' => 1],
            ['description' => 'Sleeveless', 'status' => 1],
            ['description' => 'Others', 'status' => 1],
            ['description' => 'Not Applicable', 'status' => 1],
        ];

        foreach ($sleeveRecords as $key => $record)
        {
            Sleeve::create($record);
        }
    }
}
