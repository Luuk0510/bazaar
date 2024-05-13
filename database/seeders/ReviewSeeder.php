<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{

    public function run(): void
    {
        $reviews = [
            'Dit is verreweg het beste product dat ik ooit heb gebruikt. De kwaliteit is onovertroffen en elke cent waard. Ik ben ontzettend blij met mijn aankoop en zou het iedereen aanbevelen.' => 10,
            'Zeer tevreden met dit product. Het voldoet aan al mijn verwachtingen en de prestaties zijn top. Kleine verbeterpunten zijn er wel, maar die zijn te verwaarlozen.' => 8,
            'Goed product met enkele kleine tekortkomingen. Over het algemeen ben ik tevreden, maar er is ruimte voor verbetering.' => 7,
            'Het product doet wat het belooft, maar ik ben niet bijzonder onder de indruk. Het is gemiddeld niet slecht, maar ook niet uitzonderlijk.' => 6,
            'Helaas voldeed het product niet helemaal aan mijn verwachtingen. Er zijn een paar issues die aandacht behoeven. Hopelijk verbetert de volgende versie.' => 5,
            'Teleurgesteld in dit product. Het heeft meerdere problemen en voldoet niet aan de beloofde specificaties. Ik had meer verwacht voor deze prijs.' => 4,
            'Dit is een van de slechtste aankopen die ik ooit heb gedaan. Het product is defect, de klantenservice is onbereikbaar, en ik voel me totaal misleid. Ik raad dit ten zeerste af.' => 2,
            'Dit product heeft mijn leven veranderd! De kwaliteit, efficiëntie en het gebruiksgemak zijn ongeëvenaard. Ik kan me niet voorstellen zonder te leven.' => 9,
            'Het product doet wat beloofd wordt, maar ik was niet weggeblazen. Het is functioneel en nuttig, maar ik zal waarschijnlijk rondkijken voor alternatieven in de toekomst.' => 6,
            'Er zijn dingen die ik leuk vind aan dit product en aspecten die ik niet leuk vind. Het is een mix van goede en slechte punten, waardoor mijn algehele ervaring gemengd is.' => 5,
            'Dit product viel tegen. Het miste de beloofde functies en prestaties, wat resulteerde in een frustrerende ervaring.' => 3,
            'Dit product is een totale mislukking. Het werkt niet zoals geadverteerd en veroorzaakt meer problemen dan het oplost. Ik raad iedereen af dit te kopen.' => 1,
            'Een absolute topper! Elke dag gebruik ik het product en het blijft me verbazen met zijn consistentie en duurzaamheid. Een slimme investering.' => 9,
            'Blij verrast met de kwaliteit gezien de prijs. Het is niet perfect, maar biedt zeker waar voor je geld. Zou opnieuw kopen!' => 7,
            'Voldoet aan de basisbehoeften, maar blinkt nergens in uit. Prima voor tijdelijk gebruik, maar ik zou op zoek gaan naar iets beters voor de lange termijn.' => 5,
            'Enigszins teleurstellend. Ik had hogere verwachtingen op basis van de reviews. Het werkt, maar ik loop tegen enkele irritante beperkingen aan.' => 4,
            'Frustrerend en tijdrovend om mee te werken. Meerdere pogingen gedaan om het product naar behoren te laten functioneren, maar het valt elke keer tegen.' => 3,
            'Dit product was een complete miskoop. Het voldoet niet aan enige gestelde belofte en heeft mij alleen maar hoofdpijn bezorgd. Vermijd dit ten koste van alles.' => 1,
        ];

        foreach ($reviews as $review => $rating) {
            DB::table('reviews')->insert([
                'user_id' => rand(2,5), 
                'rental_advertentie_id' => rand(1, 15), 
                'comment' => $review,
                'rating' => $rating, 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
