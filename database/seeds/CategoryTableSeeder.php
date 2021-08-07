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

        DB::table('categories')->truncate();

        $categoryRecords = [
            ['parent_id' => 0, 'section_id' => 1, 'category_name' => 'T-Shirts', 'category_image' => '', 'category_discount' => 0.00 ,'description' => '', 'url' => 'men-t-shirts', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '' , 'status' => 1],
            ['parent_id' => 1, 'section_id' => 1, 'category_name' => 'Casual T-Shirts', 'category_image' => '', 'category_discount' => 0.00 ,'description' => '', 'url' => 'men-casual-t-shirts', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '' , 'status' => 1],
            ['parent_id' => 1, 'section_id' => 1, 'category_name' => 'Formal T-Shirts', 'category_image' => '', 'category_discount' => 0.00 ,'description' => '', 'url' => 'men-formal-t-shirts', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '' , 'status' => 1],
            ['parent_id' => 0, 'section_id' => 1, 'category_name' => 'Pants', 'category_image' => '', 'category_discount' => 0.00 ,'description' => '', 'url' => 'men-pants', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '' , 'status' => 1],
            ['parent_id' => 4, 'section_id' => 1, 'category_name' => 'Casual Pants', 'category_image' => '', 'category_discount' => 0.00 ,'description' => '', 'url' => 'men-casual-pants', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '' , 'status' => 1],
            ['parent_id' => 4, 'section_id' => 1, 'category_name' => 'Formal Pants', 'category_image' => '', 'category_discount' => 0.00 ,'description' => '', 'url' => 'men-formal-pants', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '' , 'status' => 1],
            ['parent_id' => 0, 'section_id' => 1, 'category_name' => 'Shoes', 'category_image' => '', 'category_discount' => 0.00 ,'description' => '', 'url' => 'men-shoes', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '' , 'status' => 1],
            ['parent_id' => 7, 'section_id' => 1, 'category_name' => 'Casual Shoes', 'category_image' => '', 'category_discount' => 0.00 ,'description' => '', 'url' => 'men-casual-shoes', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '' , 'status' => 1],
            ['parent_id' => 7, 'section_id' => 1, 'category_name' => 'Formal Shoes', 'category_image' => '', 'category_discount' => 0.00 ,'description' => '', 'url' => 'men-formal-shoes', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '' , 'status' => 1],
            ['parent_id' => 0, 'section_id' => 1, 'category_name' => 'T-Shirts', 'category_image' => '', 'category_discount' => 0.00 ,'description' => '', 'url' => 'women-t-shirts', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '' , 'status' => 1],
            ['parent_id' => 10, 'section_id' => 2, 'category_name' => 'Casual T-Shirts', 'category_image' => '', 'category_discount' => 0.00 ,'description' => '', 'url' => 'women-casual-t-shirts', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '' , 'status' => 1],
            ['parent_id' => 10, 'section_id' => 2, 'category_name' => 'Formal T-Shirts', 'category_image' => '', 'category_discount' => 0.00 ,'description' => '', 'url' => 'women-formal-t-shirts', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '' , 'status' => 1],
            ['parent_id' => 0, 'section_id' => 2, 'category_name' => 'Pants', 'category_image' => '', 'category_discount' => 0.00 ,'description' => '', 'url' => 'women-pants', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '' , 'status' => 1],
            ['parent_id' => 13, 'section_id' => 2, 'category_name' => 'Casual Pants', 'category_image' => '', 'category_discount' => 0.00 ,'description' => '', 'url' => 'women-casual-pants', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '' , 'status' => 1],
            ['parent_id' => 13, 'section_id' => 2, 'category_name' => 'Formal Pants', 'category_image' => '', 'category_discount' => 0.00 ,'description' => '', 'url' => 'women-formal-pants', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '' , 'status' => 1],
            ['parent_id' => 0, 'section_id' => 2, 'category_name' => 'Shoes', 'category_image' => '', 'category_discount' => 0.00 ,'description' => '', 'url' => 'women-shoes', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '' , 'status' => 1],
            ['parent_id' => 16, 'section_id' => 2, 'category_name' => 'Casual Shoes', 'category_image' => '', 'category_discount' => 0.00 ,'description' => '', 'url' => 'women-casual-shoes', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '' , 'status' => 1],
            ['parent_id' => 16, 'section_id' => 2, 'category_name' => 'Formal Shoes', 'category_image' => '', 'category_discount' => 0.00 ,'description' => '', 'url' => 'women-formal-shoes', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '' , 'status' => 1],
        ];

        foreach ($categoryRecords as $key => $record)
        {
            Category::create($record);
        }
    }
}
