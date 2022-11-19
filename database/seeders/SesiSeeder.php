<?php

namespace Database\Seeders;

use App\Models\Sesi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SesiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sesi::truncate();

        Sesi::create([
            'jam_awal' => '14:00',
            'jam_akhir' => '15:00',
            'nama' => 'Sesi Siang'
        ]);

        Sesi::create([
            'jam_awal' => '19:00',
            'jam_akhir' => '20:00',
            'nama' => 'Sesi Malam'
        ]);
    }
}
