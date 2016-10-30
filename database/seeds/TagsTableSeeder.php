<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker\Factory::create();
        
        $tags = ['Bangladesh', 'Dhaka', 'Cricket', 'Shakib Al Hasan', 'Mustafizur Rahman', 'Election', 
            'Champions Trophy 2017', 'Recipe', 'US Election', 'Entertainment', 'Nobel Prize', 'Football'];
        
        foreach ($tags as $tag) {
            DB::table('tags')->insert([
                'name' => $tag,
                'slug' => str_slug($tag, '-'),
                'created_by' => $faker->randomElement(App\Models\User::pluck('id')->toArray()),
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisMonth(),
            ]);
        }
    }

}
