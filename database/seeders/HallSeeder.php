<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $halls = [
            [
                'name' => 'Hall A - IMAX',
                'capacity' => 50,
                'description' => 'Our premium IMAX theater with state-of-the-art sound and visuals.',
                'is_active' => true
            ],
            [
                'name' => 'Hall B - Standard',
                'capacity' => 50,
                'description' => 'Standard theater with comfortable seating.',
                'is_active' => true
            ],
            [
                'name' => 'Hall C - VIP',
                'capacity' => 50,
                'description' => 'VIP theater with reclining seats and personal service.',
                'is_active' => true
            ]
        ];

        // Insert halls
        DB::table('halls')->insert($halls);
        
        $this->command->info('Halls created successfully!');
    }
} 