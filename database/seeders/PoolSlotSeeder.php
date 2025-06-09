<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PoolSlot;

class PoolSlotSeeder extends Seeder
{
    public function run(): void
    {
        PoolSlot::truncate();
        PoolSlot::insert([
            [
                'name' => 'Early Morning',
                'start_time' => '06:00:00',
                'end_time' => '08:00:00',
                'price' => 10.00,
            ],
            [
                'name' => 'Afternoon',
                'start_time' => '13:00:00',
                'end_time' => '15:00:00',
                'price' => 15.00,
            ],
            [
                'name' => 'Evening',
                'start_time' => '18:00:00',
                'end_time' => '20:00:00',
                'price' => 20.00,
            ],
        ]);
    }
}
