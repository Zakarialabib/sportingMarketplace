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
                'id'                    => 1,
                'name'                  => 'Triathlon Dar Bouazza',
                'description'           => 'Triathlon Dar Bouazza',
                'images'                => \App\Helpers::addMediaFromUrlToCollection(new Race(), 'https://static.lematin.ma/files/lematin/images/articles/2017/09/Triathlon-.jpg', 'local_files')->file_name,
                'date'                  => '2023-10-10',
                'slug'                  => 'triatlhon-dar-bouazza-casablanca',
                'race_location_id'      => 1,
                'category_id'           => 1,
                'start_registration'    => date('Y-m-d', strtotime('+1 day')),  
                'end_registration'      => date('Y-m-d', strtotime('+30 day')),
                'registration_deadline' => date('Y-m-d', strtotime('+30 day')),
                'number_of_days'        => 3,
                'number_of_racers'      => 100,
                'price'                 => 1000,
                'discount_price'        => 800,
                'social_media'          => json_encode([
                    ['name' => 'Facebook', 'value' => 'https://www.facebook.com/triathlondarabouazza'],
                    ['name' => 'Instagram', 'value' => 'https://www.instagram.com/triathlondarabouazza'],
                ]),
                'sponsors' => json_encode([
                    ['name' => 'ABC Company', 'image' => 'https://example.com/images/abc.png', 'link' => 'https://www.abc.com'],
                    ['name' => 'XYZ Corporation', 'image' => 'https://example.com/images/xyz.png', 'link' => 'https://www.xyz.com'],
                ]),
                'course' => json_encode([
                    ['name' => 'swim', 'content' => 'Swim course details'],
                    ['name' => 'bike', 'content' => 'Bike course details'],
                    ['name' => 'run', 'content' => 'Run course details'],
                ]),
                'features' => json_encode([
                    'Tshirt',
                    'Sac',
                    'Médaille du finisher',
                    'Résultats',
                    'Prix',
                    'Ravitaillement pendant la course',
                    'Ravitaillement post-course',
                ]),
                'options'  => null,
                'calendar' => json_encode([
                    [
                        'date'   => '14/07',
                        'events' => [
                            [
                                'start_time' => '18h00',
                                'end_time'   => '20h00',
                                'activity'   => 'Pasta Party',
                            ],
                        ],
                    ],
                    [
                        'date'   => '15/07',
                        'events' => [
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
                                'end_time'   => '16h00',
                                'activity'   => 'Fin des épreuves',
                            ],
                        ],
                    ],
                    [
                        'date'   => '16/07',
                        'events' => [
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
                    ],
                ], ),
                'status' => true,
            ],
        ]);
    }
}
