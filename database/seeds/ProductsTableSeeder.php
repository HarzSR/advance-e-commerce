<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add Products

        DB::table('products')->truncate();

        $productRecords = [
            ['category_id' => 0, 'section_id' => 1, 'product_name' => 'T-Shirts', 'product_code' => '', 'product_color' => 0.00 ,'product_price' => '', 'product_discount' => 'men-t-shirts', 'product_weight' => '', 'product_video' => '', 'main_image' => '',  'description' => '',  'wash_care' => '',  'fabric' => '',  'pattern' => '',  'sleeve' => '',  'fit' => '',  'occasion' => '', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '',  'is_featured' => '', 'status' => 1],
        ];

        foreach ($productRecords as $key => $record)
        {
            Product::create($record);
        }
    }
}
