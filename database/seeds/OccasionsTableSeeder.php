<?php

use App\Occasion;
use Illuminate\Database\Seeder;

class OccasionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('occasions')->truncate();

        $occasionRecords = [
            ['description' => 'Formal', 'status' => 1],
            ['description' => 'Casual', 'status' => 1],
            ['description' => 'Business Formal', 'status' => 1],
            ['description' => 'Business Casual', 'status' => 1],
            ['description' => 'Others', 'status' => 1],
            ['description' => 'Not Applicable', 'status' => 1],
        ];

        foreach ($occasionRecords as $key => $record)
        {
            Occasion::create($record);
        }
    }
}
