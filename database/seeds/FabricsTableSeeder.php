<?php

use App\Fabric;
use Illuminate\Database\Seeder;

class FabricsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add Fabrics

        DB::table('fabrics')->truncate();

        $fabricRecords = [
            ['description' => 'Cotton', 'status' => 1],
            ['description' => 'Rayon', 'status' => 1],
            ['description' => 'Silk', 'status' => 1],
            ['description' => 'Polyester', 'status' => 1],
            ['description' => 'Wool', 'status' => 1],
            ['description' => 'Synthetic', 'status' => 1],
            ['description' => 'Others', 'status' => 1],
            ['description' => 'Not Applicable', 'status' => 1],
        ];

        foreach ($fabricRecords as $key => $record)
        {
            Fabric::create($record);
        }
    }
}
