<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\RentalAdvertisement;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Seeder;

class RentalAdvertisementSeeder extends Seeder
{

    public function run(): void
    {
        $faker = Faker::create();

        $rentalAdvertisements = [
            [
                'category' => 'Electronics',
                'title' => 'Draagbare Projector',
                'description' => 'Huur een draagbare HD projector voor je volgende filmavond of presentatie. Eenvoudig in gebruik en levert heldere beelden.',
            ],
            [
                'category' => 'Sporting Goods',
                'title' => 'Kajak en Peddels',
                'description' => 'Geniet van een dag op het water met onze kajakverhuur. Inclusief kajak, peddels, en veiligheidsvesten.',
            ],
            [
                'category' => 'Services',
                'title' => 'DJ voor Evenementen',
                'description' => 'Boek een DJ voor je volgende evenement. Ervaren met bruiloften, feesten en bedrijfsevenementen. Brengt eigen apparatuur mee.',
            ],
            [
                'category' => 'Real Estate',
                'title' => 'Vergaderruimte voor een Dag',
                'description' => 'Moderne vergaderruimte beschikbaar voor verhuur. Volledig uitgerust met AV-apparatuur, ideaal voor workshops of team meetings.',
            ],
            [
                'category' => 'Cars & Vehicles',
                'title' => 'Luxe Auto voor Speciale Gelegenheden',
                'description' => 'Maak je speciale dag nog onvergetelijker met onze luxe autoverhuur. Inclusief chauffeur.',
            ],
            [
                'category' => 'Clothing & Accessories',
                'title' => 'Designer Galajurk',
                'description' => 'Steel de show met een designer galajurk. Beschikbaar in diverse maten en stijlen voor je volgende formele evenement.',
            ],
            [
                'category' => 'Home & Garden',
                'title' => 'Hogedrukreiniger',
                'description' => 'Huur een krachtige hogedrukreiniger voor al je buiten schoonmaakwerkzaamheden. Makkelijk in gebruik en zeer effectief.',
            ],
            [
                'category' => 'Toys & Games',
                'title' => 'Springkussen',
                'description' => 'Maak elk kinderfeestje onvergetelijk met ons springkussen. Veilig, schoon en gegarandeerd plezier voor uren.',
            ],
            [
                'category' => 'Health & Beauty',
                'title' => 'Mobiele Massageservice',
                'description' => 'Ontspan met een professionele massage bij je thuis. Kies uit diverse behandelingen om te ontspannen en te verjongen.',
            ],
            [
                'category' => 'Books & Magazines',
                'title' => 'Set Educatieve Boeken',
                'description' => 'Breid je kennis uit met onze educatieve boekenset, ideaal voor studenten en levenslange leerlingen. Beschikbaar voor korte- en langetermijnverhuur.',
            ],
            [
                'category' => 'Electronics',
                'title' => 'Geluidsinstallatie',
                'description' => 'Huur een professionele geluidsinstallatie voor je evenement. Inclusief microfoons, speakers, en mengpaneel.',
            ],
            [
                'category' => 'Sporting Goods',
                'title' => 'Tennisset',
                'description' => 'Complete tennisset te huur, inclusief rackets en ballen. Perfect voor een spontaan spelletje of een dagje uit.',
            ],
            [
                'category' => 'Services',
                'title' => 'Fotograaf voor Evenementen',
                'description' => 'Leg je speciale momenten vast met een professionele fotograaf. Ideaal voor bruiloften, jubilea en bedrijfsevenementen.',
            ],
            [
                'category' => 'Real Estate',
                'title' => 'Vakantiehuis aan het Strand',
                'description' => 'Ontsnap aan de dagelijkse sleur met een verblijf in ons prachtige vakantiehuis aan het strand. Beschikbaar voor weekenden of weken.',
            ],
            [
                'category' => 'Cars & Vehicles',
                'title' => 'Camper',
                'description' => 'Ontdek de vrijheid van de open weg met onze camperverhuur. Volledig uitgerust en klaar voor je volgende avontuur.',
            ],
            [
                'category' => 'Clothing & Accessories',
                'title' => 'Smoking Verhuur',
                'description' => 'Zie er op je best uit met onze smoking verhuur. Beschikbaar in alle maten, inclusief accessoires.',
            ],
            [
                'category' => 'Home & Garden',
                'title' => 'Tuinmeubelset',
                'description' => 'Maak je tuin klaar voor de zomer met onze tuinmeubelverhuur. Stijlvol, comfortabel en perfect voor elk buiten evenement.',
            ],
            [
                'category' => 'Toys & Games',
                'title' => 'Videogame Console Pakket',
                'description' => 'Organiseer een game-avond met onze videogame console verhuur. Keuze uit verschillende consoles en spellen.',
            ],
            [
                'category' => 'Health & Beauty',
                'title' => 'Wellness Weekend Retreat',
                'description' => 'Herlaad jezelf met een wellness weekend, inclusief yoga, meditatie, en spa behandelingen. Volledig verzorgd en ontspannend.',
            ],
            [
                'category' => 'Books & Magazines',
                'title' => 'Reisgidsen Pakket',
                'description' => 'Plan je volgende avontuur met ons reisgidsen pakket. Up-to-date informatie over bestemmingen wereldwijd.',
            ],
        ];

        $imagePath = public_path('images/50.png');
        $imageContent = File::get($imagePath);
        $imageData = base64_encode($imageContent);

        foreach ($rentalAdvertisements as $rentalAdvertisementsData) {
            $category = Category::where('name', $rentalAdvertisementsData['category'])->first();

            $excerpt = implode(' ', array_slice(explode(' ', $rentalAdvertisementsData['description']), 0, 20)) . '...';

            if ($category) {
                RentalAdvertisement::create([
                    'user_id' => rand(1, 3),
                    'category_id' => $category->id, 
                    'title' => $rentalAdvertisementsData['title'],
                    'description' => $rentalAdvertisementsData['description'],
                    'slug' => Str::slug($rentalAdvertisementsData['title']), 
                    'image' => $imageData,    
                    'excerpt' => $excerpt,
                    'price' => $faker->randomFloat(1, 10, 500),
                ]);
            }
        }
    }
}
