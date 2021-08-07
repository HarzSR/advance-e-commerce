<?php

use App\Section;
use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add Global Sections Record

        DB::table('sections')->truncate();

        $sectionRecords = [
            ['name' => 'Men', 'status' => 1],
            ['name' => 'Women', 'status' => 1],
            ['name' => 'Kids', 'status' => 1],
        ];

        foreach ($sectionRecords as $key => $record)
        {
            Section::create($record);
        }
    }
}
