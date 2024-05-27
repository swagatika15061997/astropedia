<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Astrologer;
use Hash;

class AstrologerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obj = new Astrologer();
        $obj->name = 'Alok Das';
        $obj->email = 'alok@gmail.com';
        $obj->password = Hash::make('12345678');
        $obj->phone = '7008981223';
        $obj->status = 'pending';
        $obj->image = 'def.png';
        $obj->save();
    }
}
