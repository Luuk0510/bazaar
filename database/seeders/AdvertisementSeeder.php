<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Advertisement;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Seeder;

class AdvertisementSeeder extends Seeder
{

    public function run(): void
    {
        $faker = Faker::create();

        $advertisements = [
            [
                'category' => 'Electronics',
                'title' => 'Xbox Series X',
                'description' => 'Bijna nieuwe Xbox Series X, slechts een paar maanden oud. In perfecte staat en komt met één controller en drie games.',
            ],
            [
                'category' => 'Clothing & Accessories',
                'title' => 'Levi\'s Jeans',
                'description' => 'Klassieke Levi\'s jeans te koop, maat 32. Bijna ongedragen en zonder beschadigingen.',
            ],
            [
                'category' => 'Home & Garden',
                'title' => 'IKEA Poäng Stoel',
                'description' => 'Comfortabele IKEA Poäng stoel, ideaal voor in de woonkamer of op het balkon. Inclusief bijpassend voetenbankje.',
            ],
            [
                'category' => 'Books & Magazines',
                'title' => 'Fantasy Boekenbundel',
                'description' => 'Een verzameling van 5 bestseller fantasy boeken, in uitstekende staat. Perfect voor de liefhebber van magische werelden.',
            ],
            [
                'category' => 'Toys & Games',
                'title' => 'Lego Star Wars Set',
                'description' => 'Complete set van Lego Star Wars Millennium Falcon. Inclusief alle originele onderdelen en instructies.',
                'slug' => 'lego_starwars_set',
            ],
            [
                'category' => 'Sporting Goods',
                'title' => 'Racefiets Bianchi',
                'description' => 'Hoogwaardige Bianchi racefiets te koop. Carbon frame, Shimano versnellingen, in zeer goede staat.',
            ],
            [
                'category' => 'Health & Beauty',
                'title' => 'Philips Elektrisch Scheerapparaat',
                'description' => 'Philips Series 7000 elektrisch scheerapparaat, voor een gladde scheerbeurt zonder irritatie. Zo goed als nieuw.',
            ],
            [
                'category' => 'Cars & Vehicles',
                'title' => 'Volkswagen Golf 2018',
                'description' => 'Zuinige en betrouwbare Volkswagen Golf, 2018 model, slechts 30.000 km op de teller. Volledige onderhoudsgeschiedenis beschikbaar.',
            ],
            [
                'category' => 'Real Estate',
                'title' => 'Professionele Tuinonderhoud',
                'description' => 'Bied professionele tuinonderhoudsdiensten aan. Snoeien, maaien, plantverzorging en meer.',
            ],
            [
                'category' => 'Electronics',
                'title' => 'Samsung 4K Smart TV',
                'description' => '48 inch Samsung 4K Smart TV, haarscherp beeld en in perfect werkende staat. Inclusief afstandsbediening en Smart Hub functies.',
            ],
            [
                'category' => 'Clothing & Accessories',
                'title' => 'Ray-Ban Zonnebril',
                'description' => 'Originele Ray-Ban Aviator zonnebril met polariserende glazen. Krasvrij en met hoesje.',
            ],
            [
                'category' => 'Home & Garden',
                'title' => 'Gardena Tuinset',
                'description' => 'Complete Gardena tuinset met gereedschap en slangenwagen. Ideaal voor onderhoud van je tuin dit seizoen.',
            ],
            [
                'category' => 'Books & Magazines',
                'title' => 'Kookboeken Collectie',
                'description' => 'Grote verzameling kookboeken, variërend van Italiaans tot Aziatisch koken. Meer dan 20 titels, allemaal in uitstekende staat.',
            ],
            [
                'category' => 'Toys & Games',
                'title' => 'PlayStation 5 Console',
                'description' => 'Nieuw in doos, ongeopende PlayStation 5 console met extra DualSense controller en 2 games inbegrepen.',
            ],
            [
                'category' => 'Sporting Goods',
                'title' => 'Fitbit Fitness Tracker',
                'description' => 'Fitbit Charge 4, uitstekende staat, inclusief hartslagmeter en GPS. Perfect voor het bijhouden van je workouts en activiteit.',
            ],
            [
                'category' => 'Health & Beauty',
                'title' => 'Essentiële Oliën Set',
                'description' => 'Complete set van 100% pure essentiële oliën, ideaal voor aromatherapie, massages en ontspanning.',
            ],
            [
                'category' => 'Cars & Vehicles',
                'title' => 'Fietsendrager Thule',
                'description' => 'Zo goed als nieuwe Thule fietsendrager, geschikt voor 2 fietsen, eenvoudig te monteren op de trekhaak.',
            ],
            [
                'category' => 'Real Estate',
                'title' => 'Kantoorruimte te huur',
                'description' => 'Ruime kantoorruimte te huur in het zakendistrict, 100m², inclusief vergaderruimte en parkeerplaatsen.',
            ],
            [
                'category' => 'Services',
                'title' => 'Mobiele Autowas Service',
                'description' => 'Gemakkelijke en snelle autowas service bij jou thuis of werk. Milieuvriendelijke producten en professionele service.',
            ]
        ];

        $imagePath = public_path('images/50.png');
        $imageContent = File::get($imagePath);
        $imageData = base64_encode($imageContent);

        foreach ($advertisements as $advertisementData) {
            $category = Category::where('name', $advertisementData['category'])->first();

            $excerpt = implode(' ', array_slice(explode(' ', $advertisementData['description']), 0, 20)) . '...';

            if ($category) {
                Advertisement::create([
                    'user_id' => rand(1, 3),
                    'category_id' => $category->id, 
                    'title' => $advertisementData['title'],
                    'description' => $advertisementData['description'],
                    'slug' => Str::slug($advertisementData['title']), 
                    'image' => $imageData,    
                    'excerpt' => $excerpt,
                    'expire_date' => $faker->dateTimeBetween('now', '+1 week'),
                ]);
            }
        }
    }
}
