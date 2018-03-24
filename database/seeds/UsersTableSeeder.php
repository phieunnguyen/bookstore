<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::create([
        'name' => "Quan Quach",
        'email' => 'vinhquan.1996@gmail.com',
        'password' => bcrypt('123456'),
        'remember_token' => str_random(10)
      ]);
         factory(App\User::class, 50)->create();
    }
}
