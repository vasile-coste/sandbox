<?php

namespace Database\Seeders;

use Database\Seeders\SolutionSeeder;
use Database\Seeders\TaskContentSeeder;
use Database\Seeders\TaskSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      // \App\Models\User::factory(10)->create();

      $this->call(UserSeeder::class);
      $this->call(TaskSeeder::class);
      $this->call(TaskTestsSeeder::class);
      $this->call(SolutionSeeder::class);
 
    }
}
