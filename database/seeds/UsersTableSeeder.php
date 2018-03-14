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
			[
				'username'	=> 'timvd@18bp.be',
				'nickname'	=> 'Thaa',
				'show_nick'	=> 0,
				'password'	=> bcrypt('t1mp1312'),
				'img'		=> 'timvd.jpg',
				'active'	=> 0,
				'member_id'	=> 1,
				'tak_id'	=> 4,
			],
			[
				'username'	=> 'bart@18bp.be',
				'nickname'	=> 'Balou',
				'show_nick'	=> 0,
				'password'	=> bcrypt('18BPcoma'),
				'img'		=> 'bart.jpg',
				'active'	=> 0,
				'member_id'	=> 2,
				'tak_id'	=> 2,
			],
			[
				'username'	=> 'vincent@18bp.be',
				'nickname'	=> 'Toto',
				'show_nick'	=> 0,
				'password'	=> bcrypt('18BPcoma'),
				'img'		=> 'vincent.jpg',
				'active'	=> 1,
				'member_id'	=> 3,
				'tak_id'	=> 3,
			],
			[
				'username'	=> 'amber@18bp.be',
				'nickname'	=> 'Taki',
				'show_nick'	=> 1,
				'password'	=> bcrypt('18BPcoma'),
				'img'		=> 'amber.jpg',
				'active'	=> 1,
				'member_id'	=> 4,
				'tak_id'	=> 1,
			],
			[
				'username'	=> 'bjorn@18bp.be',
				'nickname'	=> 'Bono',
				'show_nick'	=> 1,
				'password'	=> bcrypt('18BPcoma'),
				'img'		=> 'bjorn.jpg',
				'active'	=> 1,
				'member_id'	=> 5,
				'tak_id'	=> 1,
			],
			[
				'username'	=> 'ward@18bp.be',
				'nickname'	=> 'Oro',
				'show_nick'	=> 1,
				'password'	=> bcrypt('18BPcoma'),
				'img'		=> 'ward.jpg',
				'active'	=> 1,
				'member_id'	=> 6,
				'tak_id'	=> 1,
			],
			[
				'username'	=> 'yorrik@18bp.be',
				'nickname'	=> 'Shere Khan',
				'show_nick'	=> 1,
				'password'	=> bcrypt('18BPcoma'),
				'img'		=> 'yorrik.jpg',
				'active'	=> 1,
				'member_id'	=> 7,
				'tak_id'	=> 2,
			],
			[
				'username'	=> 'aster@18bp.be',
				'nickname'	=> 'Zazoe',
				'show_nick'	=> 1,
				'password'	=> bcrypt('18BPcoma'),
				'img'		=> 'aster.jpg',
				'active'	=> 1,
				'member_id'	=> 8,
				'tak_id'	=> 2,
			],
			[
				'username'	=> 'dagmar@18bp.be',
				'nickname'	=> 'Chil',
				'show_nick'	=> 1,
				'password'	=> bcrypt('18BPcoma'),
				'img'		=> 'dagmar.jpg',
				'active'	=> 1,
				'member_id'	=> 9,
				'tak_id'	=> 2,
			],
			[
				'username'	=> 'lena@18bp.be',
				'nickname'	=> 'Kigo',
				'show_nick'	=> 1,
				'password'	=> bcrypt('18BPcoma'),
				'img'		=> 'lena.jpg',
				'active'	=> 1,
				'member_id'	=> 10,
				'tak_id'	=> 2,
			],
			[
				'username'	=> 'jannes@18bp.be',
				'nickname'	=> 'Chua',
				'show_nick'	=> 0,
				'password'	=> bcrypt('18BPcoma'),
				'img'		=> 'jannes.jpg',
				'active'	=> 1,
				'member_id'	=> 11,
				'tak_id'	=> 3,
			],
			[
				'username'	=> 'yerco@18bp.be',
				'nickname'	=> 'Phao',
				'show_nick'	=> 0,
				'password'	=> bcrypt('18BPcoma'),
				'img'		=> 'yerco.jpg',
				'active'	=> 1,
				'member_id'	=> 12,
				'tak_id'	=> 3,
			],
			[
				'username'	=> 'shana@18bp.be',
				'nickname'	=> 'Bagheera',
				'show_nick'	=> 0,
				'password'	=> bcrypt('18BPcoma'),
				'img'		=> 'shana.jpg',
				'active'	=> 1,
				'member_id'	=> 13,
				'tak_id'	=> 4,
			],
		]);
	}
}
