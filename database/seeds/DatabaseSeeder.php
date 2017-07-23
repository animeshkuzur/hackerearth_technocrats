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
    	$this->call(RoleTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(QuestionTableSeeder::class);
        $this->call(TagTableSeeder::class);
        $this->call(AnswerTableSeeder::class);
        $this->call(UserPreferenceTableSeeder::class);
        $this->call(QuestionUpvoteTableSeeder::class);
        $this->call(AnswerUpvoteTableSeeder::class);
    }
}
