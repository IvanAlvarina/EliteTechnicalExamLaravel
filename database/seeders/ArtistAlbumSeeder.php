<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Artist;
use App\Models\Album;
use Faker\Factory as Faker;

class ArtistAlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $file = storage_path('csv\Data_Reference_(ALBUM_SALES).csv');

        

        if (!file_exists($file)) {
            return;
        }

        $data = array_map('str_getcsv', file($file));
        array_shift($data);

        foreach ($data as $row) {
            $artist = Artist::firstOrCreate([
                'name' => $row[0],
            ]);

            Album::create([
                'artist_id' => $artist->id,
                'name' => $row[1],
                'year' => '20' . substr($row[3], 0, 2),
                'sales' => $row[2] ?? 0,
            ]);
        }

    }
}
