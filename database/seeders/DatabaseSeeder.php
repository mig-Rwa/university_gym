<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(MembershipSeeder::class);

        $this->call(\Database\Seeders\PoolSlotSeeder::class);
        $this->call(\Database\Seeders\CourtSlotSeeder::class);
    }
}
