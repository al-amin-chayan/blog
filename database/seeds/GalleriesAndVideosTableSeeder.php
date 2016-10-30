<?php

use Illuminate\Database\Seeder;
use App\Models\Gallery;
use App\Models\Video;

class GalleriesAndVideosTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $data = [
            'Programming' => [
                [
                    'provider' => 'Y',
                    'title' => 'So you want to be a software engineer',
                    'source' => 'https://www.youtube.com/embed/WkXzlkOWLE0'
                ],
                [
                    'provider' => 'Y',
                    'title' => 'How web works',
                    'source' => 'https://www.youtube.com/embed/uk7xi0q0jms'
                ],
                [
                    'provider' => 'Y',
                    'title' => 'How can i become a good programmer',
                    'source' => 'https://www.youtube.com/embed/BjKmWk3oE4E'
                ],
                [
                    'provider' => 'Y',
                    'title' => 'Job interview for programmer',
                    'source' => 'https://www.youtube.com/embed/JtKqGa66CTM'
                ],
                [
                    'provider' => 'Y',
                    'title' => 'Programmer Life',
                    'source' => 'https://www.youtube.com/embed/_Nua3Cjdik0'
                ]
            ],
            'Science' => [
            ],
            'Bangladesh' => [
                [
                    'provider' => 'Y',
                    'title' => 'Beautiful Bangladesh - Land Of Stories',
                    'source' => 'https://www.youtube.com/embed/QNUSIOMb6vI'
                ],
                [
                    'provider' => 'Y',
                    'title' => 'Bangladesh vat tvc HQ',
                    'source' => 'https://www.youtube.com/embed/BpQLRDLePDc'
                ],
                [
                    'provider' => 'Y',
                    'title' => 'Top 10 Best catches in Bangladesh cricket history',
                    'source' => 'https://www.youtube.com/embed/hrdqtUGT4Rs'
                ]
            ],
            'Motivational' => [
                [
                    'provider' => 'Y',
                    'title' => 'NON STOP ! - MOTIVATIONAL VIDEO',
                    'source' => 'https://www.youtube.com/embed/mAwVuRlTYO4'
                ],
                [
                    'provider' => 'Y',
                    'title' => 'Ripple - Inspirational Tear-jerking Short Film',
                    'source' => 'https://www.youtube.com/embed/ovj5dzMxzmc'
                ],
                [
                    'provider' => 'Y',
                    'title' => 'My Dad is a Liar',
                    'source' => 'https://www.youtube.com/embed/EZgmj5ay5Bk'
                ],
                [
                    'provider' => 'Y',
                    'title' => 'Stay hungry...Stay foolish',
                    'source' => 'https://www.youtube.com/embed/gO6cFMRqXqU'
                ]
            ],
            'Miscellaneous' => [
                [
                    'provider' => 'Y',
                    'title' => 'These Powerful Pictures speaks more than anything',
                    'source' => 'https://www.youtube.com/embed/6ZTesf5pNjw'
                ],
                [
                    'provider' => 'Y',
                    'title' => 'Together Everyone Achieves More',
                    'source' => 'https://www.youtube.com/embed/OVf3T3pgL8U'
                ],
                [
                    'provider' => 'Y',
                    'title' => 'Good teamwork and bad teamwork',
                    'source' => 'https://www.youtube.com/embed/fUXdrl9ch_Q'
                ],
                [
                    'provider' => 'Y',
                    'title' => 'This is your life',
                    'source' => 'https://www.youtube.com/embed/RL-lfcihHvU'
                ],
                [
                    'provider' => 'F',
                    'title' => 'Motivational Videos for Students',
                    'source' => 'https://www.facebook.com/wubedubd/videos/10154365905494972/'
                ]
            ]
        ];

        $faker = Faker\Factory::create();
        DB::beginTransaction();

//        $gallery_video = [];
//        foreach ($data as $gallery_name => $videos) {
//            $gallery_id = DB::table('galleries')->insertGetId([
//                'name' => $gallery_name,
//                'description' => $faker->text,
//                'display' => 'Y',
//                'created_at' => $faker->dateTimeThisYear(),
//                'updated_at' => $faker->dateTimeThisMonth(),
//            ]);
//
//            if (count($videos) > 0) {
//                foreach ($videos as $video) {
//                    $video_id = DB::table('videos')->insertGetId([
//                        'provider' => $video['provider'],
//                        'title' => $video['title'],
//                        'summary' => $faker->text,
//                        'source' => $video['source'],
//                        'display' => 'Y',
//                        'created_at' => $faker->dateTimeThisYear(),
//                        'updated_at' => $faker->dateTimeThisMonth(),
//                    ]);
//                    $gallery_video[] = [
//                        'gallery_id' => $gallery_id,
//                        'video_id' => $video_id
//                    ];
//                }
//            }
//        }
//
//        if (count($gallery_video) > 0) {
//            DB::table('gallery_video')->insert($gallery_video);
//        }

        foreach ($data as $gallery_name => $videos) {
            $gallery = Gallery::create([
                'name' => $gallery_name,
                'description' => $faker->text,
                'display' => 'Y',
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisMonth()
            ]);
            
            if (count($videos) > 0) {
                foreach ($videos as $video) {
                    $aVideo = Video::create([
                        'provider' => $video['provider'],
                        'title' => $video['title'],
                        'summary' => $faker->text,
                        'source' => $video['source'],
                        'display' => 'Y',
                        'created_at' => $faker->dateTimeThisYear(),
                        'updated_at' => $faker->dateTimeThisMonth()
                    ]);
                    
                    $gallery->videos()->attach($aVideo);
                }
            }
        }

        DB::commit();
    }

}
