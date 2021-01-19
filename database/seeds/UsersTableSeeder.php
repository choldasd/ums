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
            'name' => "John Doe",
            'email' => 'john@gmail.com',
            'password' => bcrypt('user@123'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'status' => "A"
        ]);
        DB::table('users')->insert([
            'name' => "Rahul Patil",
            'email' => 'rahul@gmail.com',
            'password' => bcrypt('user@123'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'status' => "A"
        ]);
        DB::table('users')->insert([
            'name' => "Amol Patil",
            'email' => 'amol@gmail.com',
            'password' => bcrypt('user@123'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'status' => "D"
        ]);
        DB::table('users')->insert([
            'name' => "Ronit Roy",
            'email' => 'ronit@gmail.com',
            'password' => bcrypt('user@123'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'status' => "A"
        ]);
        DB::table('users')->insert([
            'name' => "Jayesh Chaudhari",
            'email' => 'jayesh@gmail.com',
            'password' => bcrypt('user@123'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'status' => "A"
        ]);
        DB::table('users')->insert([
            'name' => "Sonal Roy",
            'email' => 'sonal@gmail.com',
            'password' => bcrypt('user@123'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'status' => "A"
        ]);
        DB::table('users')->insert([
            'name' => "Sony Jackson",
            'email' => 'sony@gmail.com',
            'password' => bcrypt('user@123'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'status' => "A"
        ]);
        DB::table('users')->insert([
            'name' => "Peter Parker",
            'email' => 'peter@gmail.com',
            'password' => bcrypt('user@123'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'status' => "A"
        ]);
        DB::table('users')->insert([
            'name' => "James Karlos",
            'email' => 'james@gmail.com',
            'password' => bcrypt('user@123'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'status' => "D"
        ]);
        DB::table('users')->insert([
            'name' => "Kelly Patil",
            'email' => 'kelly@gmail.com',
            'password' => bcrypt('user@123'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'status' => "A"
        ]);
        DB::table('users')->insert([
            'name' => "Serina parker",
            'email' => 'serina@gmail.com',
            'password' => bcrypt('user@123'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'status' => "D"
        ]);

        
 
    }
}
