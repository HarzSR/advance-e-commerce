<?php

use App\Fit;
use Illuminate\Database\Seeder;

class FitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('fits')->truncate();

        $fitRecords = [
            ['description' => 'Slim', 'status' => 1],
            ['description' => 'Regular', 'status' => 1],
            ['description' => 'Skinny', 'status' => 1],
            ['description' => 'Tapped', 'status' => 1],
            ['description' => 'Loose', 'status' => 1],
            ['description' => 'Others', 'status' => 1],
            ['description' => 'Not Applicable', 'status' => 1],
        ];

        foreach ($fitRecords as $key => $record)
        {
            Fit::create($record);
        }
    }
}
