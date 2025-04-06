<?php namespace Database\Seeders;

use Database\Seeders\FAQSeeder;
use Database\Seeders\GroupSeeder;
use Database\Seeders\UserSeeder;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call([GroupSeeder::class, FAQSeeder::class, UserSeeder::class]);
    }
}
