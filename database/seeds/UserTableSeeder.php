<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data1['name']       = 'Administrator';
		$data1['email']      = 'admin@st-joris-turnhout.be';
        $data1['theme']      = 'skin-red';
		$data1['password']   = bcrypt('root1995');

        $data2['name']       = 'Tim Joosten'; 
        $data2['email']      = 'Topairy@gmail.com'; 
        $data2['theme']      = 'skin-red';
        $data2['password']   = bcrypt('admin1995');

		$table = DB::table('users');
		$table->delete();

        $create1 = User::create($data1);
        $create2 = User::create($data2);

        $user1   = User::find($create1->id);
        $user2   = User::find($create2->id);

        $user1->givePermissionTo('active');
        $user1->givePermissionTo('admin');

        $user2->givePermissionTo('active');
    }
}
