<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RentalReviewSeeder extends Seeder
{

    public function run(): void
    {
        $reviews = [
            [
                'title' => 'Beste product ooit gebruikt',
                'comment' => 'Dit is verreweg het beste product dat ik ooit heb gebruikt. De kwaliteit is onovertroffen en elke cent waard. Ik ben ontzettend blij met mijn aankoop en zou het iedereen aanbevelen.',
                'rating' => 10,
            ],
            [
                'title' => 'Zeer tevreden',
                'comment' => 'Zeer tevreden met dit product. Het voldoet aan al mijn verwachtingen en de prestaties zijn top. Kleine verbeterpunten zijn er wel, maar die zijn te verwaarlozen.',
                'rating' => 8,
            ],
            [
                'title' => 'Goed, maar met ruimte voor verbetering',
                'comment' => 'Goed product met enkele kleine tekortkomingen. Over het algemeen ben ik tevreden, maar er is ruimte voor verbetering.',
                'rating' => 7,
            ],
            [
                'title' => 'Gemiddeld, niet bijzonder onder de indruk',
                'comment' => 'Het product doet wat het belooft, maar ik ben niet bijzonder onder de indruk. Het is gemiddeld niet slecht, maar ook niet uitzonderlijk.',
                'rating' => 6,
            ],
            [
                'title' => 'Teleurstellend',
                'comment' => 'Helaas voldeed het product niet helemaal aan mijn verwachtingen. Er zijn een paar issues die aandacht behoeven. Hopelijk verbetert de volgende versie.',
                'rating' => 5,
            ],
            [
                'title' => 'Niet aan verwachtingen voldaan',
                'comment' => 'Teleurgesteld in dit product. Het heeft meerdere problemen en voldoet niet aan de beloofde specificaties. Ik had meer verwacht voor deze prijs.',
                'rating' => 4,
            ],
            [
                'title' => 'Slechtste aankoop ooit',
                'comment' => 'Dit is een van de slechtste aankopen die ik ooit heb gedaan. Het product is defect, de klantenservice is onbereikbaar, en ik voel me totaal misleid. Ik raad dit ten zeerste af.',
                'rating' => 2,
            ],
            [
                'title' => 'Levensveranderend product',
                'comment' => 'Dit product heeft mijn leven veranderd! De kwaliteit, efficiëntie en het gebruiksgemak zijn ongeëvenaard. Ik kan me niet voorstellen zonder te leven.',
                'rating' => 9,
            ],
            [
                'title' => 'Functioneel, maar niet indrukwekkend',
                'comment' => 'Het product doet wat beloofd wordt, maar ik was niet weggeblazen. Het is functioneel en nuttig, maar ik zal waarschijnlijk rondkijken voor alternatieven in de toekomst.',
                'rating' => 6,
            ],
            [
                'title' => 'Gemengde gevoelens',
                'comment' => 'Er zijn dingen die ik leuk vind aan dit product en aspecten die ik niet leuk vind. Het is een mix van goede en slechte punten, waardoor mijn algehele ervaring gemengd is.',
                'rating' => 5,
            ],
            [
                'title' => 'Onder de maat',
                'comment' => 'Dit product viel tegen. Het miste de beloofde functies en prestaties, wat resulteerde in een frustrerende ervaring.',
                'rating' => 3,
            ],
            [
                'title' => 'Totale mislukking',
                'comment' => 'Dit product is een totale mislukking. Het werkt niet zoals geadverteerd en veroorzaakt meer problemen dan het oplost. Ik raad iedereen af dit te kopen.',
                'rating' => 1,
            ],
            [
                'title' => 'Topper!',
                'comment' => 'Een absolute topper! Elke dag gebruik ik het product en het blijft me verbazen met zijn consistentie en duurzaamheid. Een slimme investering.',
                'rating' => 9,
            ],
            [
                'title' => 'Waar voor je geld',
                'comment' => 'Blij verrast met de kwaliteit gezien de prijs. Het is niet perfect, maar biedt zeker waar voor je geld. Zou opnieuw kopen!',
                'rating' => 7,
            ],
            [
                'title' => 'Voldoet aan basisbehoeften',
                'comment' => 'Voldoet aan de basisbehoeften, maar blinkt nergens in uit. Prima voor tijdelijk gebruik, maar ik zou op zoek gaan naar iets beters voor de lange termijn.',
                'rating' => 5,
            ],
            [
                'title' => 'Enigszins teleurstellend',
                'comment' => 'Enigszins teleurstellend. Ik had hogere verwachtingen op basis van de reviews. Het werkt, maar ik loop tegen enkele irritante beperkingen aan.',
                'rating' => 4,
            ],
            [
                'title' => 'Frustrerend om mee te werken',
                'comment' => 'Frustrerend en tijdrovend om mee te werken. Meerdere pogingen gedaan om het product naar behoren te laten functioneren, maar het valt elke keer tegen.',
                'rating' => 3,
            ],
            [
                'title' => 'Complete miskoop',
                'comment' => 'Dit product was een complete miskoop. Het voldoet niet aan enige gestelde belofte en heeft mij alleen maar hoofdpijn bezorgd. Vermijd dit ten koste van alles.',
                'rating' => 1,
            ],
        ];

        foreach($reviews as $review) {
            DB::table('rental_reviews')->insert([
                'reviewer_id' => rand(2, 5), // Zorg ervoor dat deze id's bestaan in jouw users tabel of gebruik User::factory()->create()->id voor echte id's
                'rental_advertisement_id' => rand(1, 15), // Zorg ervoor dat deze id's bestaan in jouw rental_advertisements tabel of gebruik RentalAdvertisement::factory()->create()->id voor echte id's
                'title' => $review['title'],
                'comment' => $review['comment'],
                'rating' => $review['rating'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
