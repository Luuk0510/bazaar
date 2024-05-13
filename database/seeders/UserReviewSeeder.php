<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserReviewSeeder extends Seeder
{
    public function run(): void
    {
        $userReviews = [
            [
                'title' => 'Zeer betrouwbaar',
                'comment' => 'Deze gebruiker is zeer betrouwbaar, de communicatie verliep soepel en alles was zoals afgesproken.',
                'rating' => 5,
            ],
            [
                'title' => 'Erg behulpzaam',
                'comment' => 'Erg behulpzaam bij het beantwoorden van mijn vragen. Ik voelde me goed ondersteund gedurende het hele proces.',
                'rating' => 5,
            ],
            [
                'title' => 'Goede service',
                'comment' => 'De service was boven verwachting. Zou zeker aanbevelen!',
                'rating' => 5,
            ],
            [
                'title' => 'Reageert erg laat',
                'comment' => 'Alles was uiteindelijk in orde, maar de reactietijd kon veel beter. Het duurde dagen voordat ik antwoord kreeg.',
                'rating' => 3,
            ],
            [
                'title' => 'Niet zo betrouwbaar als gehoopt',
                'comment' => 'Helaas waren er enkele problemen met de betrouwbaarheid. Afspraken werden niet altijd nagekomen.',
                'rating' => 2,
            ],
            [
                'title' => 'Uitstekende communicatie',
                'comment' => 'De adverteerder was altijd beschikbaar voor vragen en gaf snel en duidelijk antwoord.',
                'rating' => 5,
            ],
            [
                'title' => 'Vriendelijk en professioneel',
                'comment' => 'Heel prettig om met deze persoon zaken te doen. Professioneel, vriendelijk, en alles was perfect geregeld.',
                'rating' => 5,
            ],
            [
                'title' => 'Kon beter',
                'comment' => 'Hoewel de uiteindelijke deal in orde was, liet de voorbereiding te wensen over. Communicatie was soms verwarrend en niet altijd even duidelijk.',
                'rating' => 3,
            ],
            [
                'title' => 'Onvoldoende voorbereid',
                'comment' => 'Het leek alsof de adverteerder niet helemaal voorbereid was op onze afspraak. Informatie ontbrak en het overzicht was verloren.',
                'rating' => 2,
            ],
            [
                'title' => 'Gebrek aan professionaliteit',
                'comment' => 'Helaas was mijn ervaring niet wat ik ervan verwachtte. Het gebrek aan professionaliteit stond centraal in onze interacties.',
                'rating' => 1,
            ],
            [
                'title' => 'Flexibel en meegaand',
                'comment' => 'De adverteerder was erg flexibel en was bereid om onze afspraak aan te passen aan onvoorziene omstandigheden. Echt gewaardeerd.',
                'rating' => 5,
            ],
            [
                'title' => 'Betrouwbaar en punctueel',
                'comment' => 'Alle afspraken werden nagekomen, en de adverteerder was altijd op tijd. Betrouwbaarheid die je niet vaak tegenkomt.',
                'rating' => 5,
            ],
            [
                'title' => 'Niet zoals geadverteerd',
                'comment' => 'Helaas kwam wat werd aangeboden niet overeen met de advertentie. Dit was een teleurstellende ervaring.',
                'rating' => 2,
            ],
            [
                'title' => 'Moeilijk in communicatie',
                'comment' => 'Het was vaak moeilijk om duidelijke antwoorden te krijgen. Dit maakte het proces onnodig ingewikkeld.',
                'rating' => 2,
            ],
            [
                'title' => 'Exceptionele service',
                'comment' => 'Alles was boven verwachting. De service, de communicatie, de afhandeling - alles was exceptioneel.',
                'rating' => 5,
            ],
        ];

        foreach($userReviews as $review) {
            do {
                $userId = rand(2, 5);
                $reviewerId = rand(2, 5);
            } while ($userId === $reviewerId);

            DB::table('user_reviews')->insert([
                'user_id' => $userId,
                'reviewer_id' => $reviewerId,
                'title' => $review['title'],
                'comment' => $review['comment'],
                'rating' => $review['rating'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
