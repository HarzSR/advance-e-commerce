<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        Artisan::call('cache:clear');
        Artisan::call('config:clear');

        $this->call(AdminsTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(SleevesTableSeeder::class);
        $this->call(FabricsTableSeeder::class);
        $this->call(PatternsTableSeeder::class);
        $this->call(FitsTableSeeder::class);
        $this->call(OccasionsTableSeeder::class);
    }
}
