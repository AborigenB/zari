<?php

namespace Database\Seeders;

use App\Models\Art;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\ArtImages;
use Illuminate\Support\Facades\Storage;

class ArtImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arts = Art::all();
        $url = Storage::disk('public')->put('arts', file_get_contents(public_path('assets/img/image5.png')));
        foreach ($arts as $art) {
            for ($i=0; $i < 4; $i++) { 
                ArtImages::create([
                    'art_id' => $art->id,
                    'url' => $url,
                ]);
            }
        }
    }
}
