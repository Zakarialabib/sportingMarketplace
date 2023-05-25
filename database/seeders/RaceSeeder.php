<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Race;
use Illuminate\Database\Seeder;

class RaceSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Race::insert([
            [
                'id'               => 1,
                'name'             => 'Triathlon Dar Bouazza',
                'description'      => 'Triathlon Dar Bouazza',
                'images'           => \App\Helpers::addMediaFromUrlToCollection(new Race(), 'https://static.lematin.ma/files/lematin/images/articles/2017/09/Triathlon-.jpg', 'local_files')->file_name,
                'date'             => '2023-10-10',
                'slug'             => 'triatlhon-dar-bouazza-casablanca',
                'race_location_id' => 1,
                'category_id'      => 1,
                'number_of_days'   => 3,
                'number_of_racers' => 100,
                'price'            => 400,
                'social_media'     => json_encode([
                    ['name' => 'Facebook', 'value' => 'https://www.facebook.com/triathlondarabouazza'],
                    ['name' => 'Instagram', 'value' => 'https://www.instagram.com/triathlondarabouazza'],
                ]),
                'sponsors' => json_encode([
                    ['name' => 'ABC Company', 'image' => 'https://example.com/images/abc.png', 'link' => 'https://www.abc.com'],
                    ['name' => 'XYZ Corporation', 'image' => 'https://example.com/images/xyz.png', 'link' => 'https://www.xyz.com'],
                ]),
                'course' => json_encode([
                    'swim' => ['content' => 'Swim course details'],
                    'bike' => ['content' => 'Bike course details'],
                    'run'  => ['content' => 'Run course details'],
                ]),
                'features' => json_encode([
                    ['value' => 'Tshirt'],
                    ['value' => 'Sac'],
                    ['value' => 'Médaille du finisher'],
                    ['value' => 'Résultats'],
                    ['value' => 'Prix'],
                    ['value' => 'Ravitaillement pendant la course'],
                    ['value' => 'Ravitaillement post-course'],
                ]),
                'options'  => null,
                'calendar' => json_encode([
                    '14/07' => [
                        [
                            'start_time' => '18h00',
                            'end_time'   => '20h00',
                            'activity'   => 'Pasta Party',
                        ],
                    ],
                    '15/07' => [
                        [
                            'start_time' => '07h00',
                            'end_time'   => '09h00',
                            'activity'   => 'Accueil des participants',
                        ],
                        [
                            'start_time' => '09h00',
                            'end_time'   => '16h00',
                            'activity'   => 'Épreuves',
                        ],
                        [
                            'start_time' => '16h00',
                            'activity'   => 'Fin des épreuves',
                        ],
                    ],
                    '16/07' => [
                        [
                            'start_time' => '10h00',
                            'end_time'   => '11h00',
                            'activity'   => 'Remise des prix',
                        ],
                        [
                            'start_time' => '11h00',
                            'end_time'   => '12h00',
                            'activity'   => 'Clôture',
                        ],
                    ],
                ], ),
                'status' => true,
            ],
        ]);
    }
}
