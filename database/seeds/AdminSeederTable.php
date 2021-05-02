<?php

use Illuminate\Database\Seeder;

class AdminSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            [
                'username' => 'admin',
                'name' => 'Supper Admin',
                'email' => 'admin@gmail.com',
                'phone' => '0356746658',
                'password' => bcrypt('admin@123'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        DB::table('admins')->insert($groups);    }
}
