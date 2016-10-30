<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker\Factory::create();
        $subjects = ['Business', 'Sports', 'Life Style', 'Health', 'IT', 'Politics', 'Science'];
        foreach ($subjects as $subject) {
            DB::table('subjects')->insert([
                'name' => $subject,
                'description' => $faker->text,
                'slug' => str_slug($subject, '-'),
                'created_by' => $faker->randomElement(App\Models\User::pluck('id')->toArray()),
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisMonth(),
            ]);
        }
    }

}
