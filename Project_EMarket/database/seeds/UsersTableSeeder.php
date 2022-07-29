<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'ThinnThinnMoe',
            'email' => 'scm.thinthinmoe@gmail.com',
            'role'=>'1',
            'password' => bcrypt('thin@123')
        ]);
        DB::table('users')->insert([
            'name' => 'NangSanKham',
            'email' => 'scm.nangsankham@gmail.com',
            'role'=>'1',
            'password' => bcrypt('nang@123')
        ]);
        DB::table('users')->insert([
            'name' => 'AyeMyaSan',
            'email' => 'scm.ayemyasan@gmail.com',
            'role'=>'1',
            'password' => bcrypt('aye@1234')
        ]);
    }
}
