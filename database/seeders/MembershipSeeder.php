<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Membership;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Membership::create([
            'type' => 'Monthly',
            'price' => 29.99,
            'duration_days' => 30,
        ]);
    
        Membership::create([
            'type' => 'Quarterly',
            'price' => 79.99,
            'duration_days' => 90,
        ]);
    
        Membership::create([
            'type' => 'Annual',
            'price' => 249.99,
            'duration_days' => 365,
        ]);
    }
}
