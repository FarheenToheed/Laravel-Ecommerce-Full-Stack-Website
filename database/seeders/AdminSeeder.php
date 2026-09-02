<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'email'=>'admin@gmail.com',
        ],[
            'name'=>'admin',
            'lastname' => 'Admin',
            'phoneno' => '03001234567',
            'password'=> Hash::make('admin123'),
            'role'=>'admin'
        ]);
    }
}
