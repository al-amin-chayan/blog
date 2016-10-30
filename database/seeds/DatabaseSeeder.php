<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seeding using normal array
        $this->call(ProfessionsTableSeeder::class);
        //Seeding using Model Factory with relation
        $this->call(UsersTableSeeder::class);
        //Seeding using faker in Seeder
        $this->call(SubjectsTableSeeder::class);
        
        $this->call(TagsTableSeeder::class);
        
        $this->call(ArticlesTableSeeder::class);
        
        $this->call(GalleriesAndVideosTableSeeder::class);
        
        $this->call(CommentsTableSeeder::class);
        
        $this->call(TaggablesTableSeeder::class);
    }
}
