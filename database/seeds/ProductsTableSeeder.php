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
            ['category_id' => 2, 'section_id' => 1, 'product_name' => 'Black Casual T-Shirt', 'product_code' => 'BKCT001', 'product_color' => 'Black' ,'product_price' => 1100.00, 'product_discount' => 11, 'product_weight' => 110, 'product_video' => '', 'main_image' => '',  'description' => 'Black Men Casual T-Shirt',  'wash_care' => 'Men Wash',  'fabric' => 'Cloth',  'pattern' => 'Solid',  'sleeve' => 'Full',  'fit' => 'Slim',  'occasion' => '', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '',  'is_featured' => 'Yes', 'status' => 1],
            ['category_id' => 3, 'section_id' => 1, 'product_name' => 'Black Formal T-Shirt', 'product_code' => 'BKFT001', 'product_color' => 'Black' ,'product_price' => 1200.00, 'product_discount' => 12, 'product_weight' => 120, 'product_video' => '', 'main_image' => '',  'description' => 'Black Men Formal T-Shirt',  'wash_care' => 'Men Wash',  'fabric' => 'Cloth',  'pattern' => 'Solid',  'sleeve' => 'Half',  'fit' => 'Slim',  'occasion' => '', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '',  'is_featured' => 'Yes', 'status' => 1],
        ];

        foreach ($productRecords as $key => $record)
        {
            Product::create($record);
        }
    }
}
