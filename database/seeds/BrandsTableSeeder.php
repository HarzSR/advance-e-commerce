<?php

use App\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add Brands

        DB::table('brands')->truncate();

        $brandRecords = [
            ['name' => 'Peter England', 'status' => 1],
            ['name' => 'Allen Solly', 'status' => 1],
            ['name' => 'Raymond', 'status' => 1],
            ['name' => 'East India Company', 'status' => 1],
            ['name' => 'Louis Philippe', 'status' => 1],
            ['name' => 'American Swan', 'status' => 1],
            ['name' => 'Others', 'status' => 1],
            ['name' => 'Not Applicable', 'status' => 1],
        ];

        foreach ($brandRecords as $key => $record)
        {
            Brand::create($record);
        }
    }
}
