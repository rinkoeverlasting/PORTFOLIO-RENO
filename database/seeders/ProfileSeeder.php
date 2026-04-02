<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profile::create([
            'name' => 'Albertus Reno Aditama',
            'age' => 19,
            'birth_date' => '2006-11-15',
            'school' => 'SMAK Frateran',
            'class' => '12 E',
            'description' => 'Seorang siswa SMAK Frateran kelas 12 E yang memiliki minat di bidang informatika dan gaming.',
            'profile_image' => null,
        ]);
    }
}
