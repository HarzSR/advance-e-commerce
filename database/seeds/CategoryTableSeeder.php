<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add Category

        $categoryRecords = [
            ['parent_id' => 0, 'section_id' => 1, 'category_name' => 'T-Shirts', 'category_image' => '', 'category_discount' => 0.00 ,'description' => '', 'url' => 't-shirts', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '' ,'status' => 1],
            ['parent_id' => 1, 'section_id' => 1, 'category_name' => 'Casuals T-Shirts', 'category_image' => '', 'category_discount' => 0.00 ,'description' => '', 'url' => 'casual-t-shirts', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '' ,'status' => 1],
        ];

        foreach ($categoryRecords as $key => $record)
        {
            Category::create($record);
        }
    }
}
