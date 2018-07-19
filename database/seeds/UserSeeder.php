!<?php

use Illmuinate\Database\Seeder;


class UserSeeder extends Seeder
{
	/**
	*
	* Run  the database seeds.
	*$return void
	*/

	public  function run()
	{
		// 
		for ($i=0; $i < 100; $i++) { 
			
			DB::table('user')->insert([
			'username' => str_random(10),
			'password' => Hash::make('12345678'),
			'mail' => str_random(10).'@gmail.com',
			'phone' => '15030013920',
			'profile' => '/uploads/0CqTjQorK91530585041.jpg',
			'status' => '1'
		]);
		}
		
	}
}