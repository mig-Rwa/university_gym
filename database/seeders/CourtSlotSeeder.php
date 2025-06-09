<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CourtSlot;

class CourtSlotSeeder extends Seeder
{
    public function run(): void
    {
        CourtSlot::truncate();
        CourtSlot::insert([
            [
                'name' => 'Basketball Court',
                'price' => 30.00,
                'start_time' => '10:00:00',
                'end_time' => '11:00:00',
            ],
            [
                'name' => 'Basketball Court',
                'price' => 30.00,
                'start_time' => '11:00:00',
                'end_time' => '12:00:00',
            ],
            [
                'name' => 'Tennis Court',
                'price' => 25.00,
                'start_time' => '10:00:00',
                'end_time' => '11:00:00',
            ],
            [
                'name' => 'Tennis Court',
                'price' => 25.00,
                'start_time' => '11:00:00',
                'end_time' => '12:00:00',
            ],
            [
                'name' => 'Football Pitch',
                'price' => 40.00,
                'start_time' => '10:00:00',
                'end_time' => '11:00:00',
            ],
            [
                'name' => 'Football Pitch',
                'price' => 40.00,
                'start_time' => '11:00:00',
                'end_time' => '12:00:00',
            ],
        ]);
    }
}
