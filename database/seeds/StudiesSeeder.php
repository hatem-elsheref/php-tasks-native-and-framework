<?php

use Illuminate\Database\Seeder;
use App\Studies;
use App\User;
use Illuminate\Support\Str;
class StudiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country_id=\App\Country::where('code','SA')->value('id');
        User::create([
            'name' => 'Administrator',
            'email' => 'system_admin@app.com',
            'role'=>'admin',
            'phone'=>'0536411647',
            'country_id'=>$country_id,
            'city'=>'Gada',
            'avatar'=>'uploads/users/default-user.png',
            'email_verified_at' => now(),
            'password' => \Illuminate\Support\Facades\Hash::make(12345678), //12345678
            'remember_token' => Str::random(10)
        ]);
        // create all the current available studies
        $studies=config('menah.available_studies');
        Studies::insert($studies);
    }
}
