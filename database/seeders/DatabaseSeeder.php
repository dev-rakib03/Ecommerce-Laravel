<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Admin;
use Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        //\App\Models\Admin::factory(10)->create();

        $get_ad=Admin::where('email','admin@boraxip.com')->first();
        if($get_ad){
            $get_ad->delete();
            Admin::create([
                'email' => 'admin@boraxip.com',
                'password' => Hash::make('12345678'),
            ]);
        }else{
            Admin::create([
                'email' => 'admin@boraxip.com',
                'password' => Hash::make('12345678'),
            ]);
        }
    }
}
