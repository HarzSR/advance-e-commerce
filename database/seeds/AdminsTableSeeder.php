<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add Global Super Admin Record

        DB::table('admins')->truncate();

        $adminRecords = [
            ['name' => 'Administrator 1', 'type' => 'admin', 'mobile' => '1234567890', 'email' => 'admin1@admin.com', 'password' => '$2y$10$Bjo7KGOk07XrRLuQbVFr1urjM4xfdrhkxRa9QaJjFjqCJnrxU4vdG', 'image' => '', 'status' => 1],
            ['name' => 'Administrator 2', 'type' => 'admin', 'mobile' => '1234567890', 'email' => 'admin2@admin.com', 'password' => '$2y$10$Bjo7KGOk07XrRLuQbVFr1urjM4xfdrhkxRa9QaJjFjqCJnrxU4vdG', 'image' => '', 'status' => 1],
            ['name' => 'Sub Admin 1', 'type' => 'sub-admin', 'mobile' => '1234567890', 'email' => 'subadmin@admin.com', 'password' => '$2y$10$Bjo7KGOk07XrRLuQbVFr1urjM4xfdrhkxRa9QaJjFjqCJnrxU4vdG', 'image' => '', 'status' => 1],
            ['name' => 'Sub Admin 2', 'type' => 'sub-admin', 'mobile' => '1234567890', 'email' => 'subadmin2@admin.com', 'password' => '$2y$10$Bjo7KGOk07XrRLuQbVFr1urjM4xfdrhkxRa9QaJjFjqCJnrxU4vdG', 'image' => '', 'status' => 1],
        ];

        // DB::table('admins')->insert($adminRecords);

        foreach ($adminRecords as $key => $record)
        {
            Admin::create($record);
        }
    }
}
