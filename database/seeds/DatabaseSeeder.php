<?php

use Illuminate\Database\Seeder;

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
		$user = factory(App\User::class)->create([
             'name' => 'admin',
             'email' => 'admin@gmail.com',
             'password' => bcrypt('admin'),
             'lastname' => 'Mr',
             'firstname' => 'admin',
            'role' => 'admin'
         ]);
        $cities=['دمشق','حمص','حماة','حلب','ادلب','اللاذقية','طرطوس','الرقة','الحسكة','دير الزور','السويداء','درعا','القنيطرة'];
        foreach($cities as $city){
            $city_name=\App\cities::create(['city_name'=>$city,'user_create'=>'admin','user_last_update'=>'admin']);
        }
    }
}
