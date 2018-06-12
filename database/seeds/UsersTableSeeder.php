<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('users')->insert([
            'username' => 'prime',
            'password' => bcrypt('prime'),
            'isAdmin'=> true,
        ]);*/
//
//        DB::table('users')->insert([
//            'username' => 'prime',
//            'email'=>'admin@admin.com',
//            'password' => bcrypt('prime'),
//            'is_admin' => true,
//        ]);

        DB::table('users')->insert([
            'username' => 'foajala',
            'email'=>'ajalataiwo@gmail.com',
            'password' => bcrypt('ajala'),
            'is_admin'=> false,
        ]);

        DB::table('users')->insert([
            'username' => 'soolabiyisiS',
            'email'=>'ajalataiwo@gmail.com',
            'password' => bcrypt('olabiyisi'),
            'is_admin'=> false,
        ]);

    }
}
