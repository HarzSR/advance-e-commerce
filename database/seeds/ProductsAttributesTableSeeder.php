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
            ['product_id' => 1, 'size' => 'Small', 'price' => 1001.00, 'stock' => 11, 'sku' => 'BKT001-S' ,'status' => 1],
            ['product_id' => 1, 'size' => 'Medium', 'price' => 1002.00, 'stock' => 12, 'sku' => 'BKT001-M' ,'status' => 1],
            ['product_id' => 1, 'size' => 'Large', 'price' => 1003.00, 'stock' => 13, 'sku' => 'BKT001-L' ,'status' => 1],
            ['product_id' => 2, 'size' => 'Small', 'price' => 2001.00, 'stock' => 21, 'sku' => 'BKCT001-S' ,'status' => 1],
            ['product_id' => 2, 'size' => 'Medium', 'price' => 2002.00, 'stock' => 22, 'sku' => 'BKCT001-M' ,'status' => 1],
            ['product_id' => 2, 'size' => 'Large', 'price' => 2003.00, 'stock' => 23, 'sku' => 'BKCT001-L' ,'status' => 1],
            ['product_id' => 3, 'size' => 'Small', 'price' => 3001.00, 'stock' => 31, 'sku' => 'BKFT001-S' ,'status' => 1],
            ['product_id' => 3, 'size' => 'Medium', 'price' => 3002.00, 'stock' => 32, 'sku' => 'BKFT001-M' ,'status' => 1],
            ['product_id' => 3, 'size' => 'Large', 'price' => 3003.00, 'stock' => 33, 'sku' => 'BKFT001-L' ,'status' => 1],
        ];

        foreach ($productsAttributeRecords as $key => $record)
        {
            ProductsAttribute::create($record);
        }
    }
}
