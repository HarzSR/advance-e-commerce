<?php

use App\ProductsAttribute;
use Illuminate\Database\Seeder;

class ProductsAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add Product Attributes

        DB::table('products_attributes')->truncate();

        $productsAttributeRecords = [
            ['product_id' => 1, 'size' => 'Small', 'price' => 101.00, 'stock' => 11, 'sku' => 'BKT001-S' ,'status' => 1],
            ['product_id' => 1, 'size' => 'Medium', 'price' => 102.00, 'stock' => 12, 'sku' => 'BKT001-M' ,'status' => 1],
            ['product_id' => 1, 'size' => 'Large', 'price' => 103.00, 'stock' => 13, 'sku' => 'BKT001-L' ,'status' => 1],
            ['product_id' => 2, 'size' => 'Small', 'price' => 201.00, 'stock' => 21, 'sku' => 'BKCT001-S' ,'status' => 1],
            ['product_id' => 2, 'size' => 'Medium', 'price' => 202.00, 'stock' => 22, 'sku' => 'BKCT001-M' ,'status' => 1],
            ['product_id' => 2, 'size' => 'Large', 'price' => 203.00, 'stock' => 23, 'sku' => 'BKCT001-L' ,'status' => 1],
            ['product_id' => 3, 'size' => 'Small', 'price' => 301.00, 'stock' => 31, 'sku' => 'BKFT001-S' ,'status' => 1],
            ['product_id' => 3, 'size' => 'Medium', 'price' => 302.00, 'stock' => 32, 'sku' => 'BKFT001-M' ,'status' => 1],
            ['product_id' => 3, 'size' => 'Large', 'price' => 303.00, 'stock' => 33, 'sku' => 'BKFT001-L' ,'status' => 1],
        ];

        foreach ($productsAttributeRecords as $key => $record)
        {
            ProductsAttribute::create($record);
        }
    }
}
