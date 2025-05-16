<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\Show;
use Carbon\Carbon;

class ShowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all movie IDs
        $movieIds = Movie::pluck('id')->toArray();
        
        if (empty($movieIds)) {
            $this->command->error('No movies found in the database. Please run the MovieSeeder first.');
            return;
        }
        
        $hallIds = [1, 2, 3]; // Assuming you have halls with these IDs
        
        // Create show times for the next 7 days
        $startDate = Carbon::today();
        
        foreach ($movieIds as $movieId) {
            // Create multiple showtimes per movie
            for ($day = 0; $day < 7; $day++) {
                $showDate = $startDate->copy()->addDays($day);
                
                // Create 3 shows per day for each movie (morning, afternoon, evening)
                $showtimes = [
                    [
                        'start_time' => '10:00:00',
                        'end_time' => '12:00:00',
                        'price' => 8.99
                    ],
                    [
                        'start_time' => '15:30:00',
                        'end_time' => '17:30:00',
                        'price' => 10.99
                    ],
                    [
                        'start_time' => '20:00:00',
                        'end_time' => '22:00:00',
                        'price' => 12.99
                    ],
                ];
                
                foreach ($showtimes as $index => $time) {
                    Show::create([
                        'movie_id' => $movieId,
                        'hall_id' => $hallIds[$index % count($hallIds)], // Rotate through halls
                        'date' => $showDate->format('Y-m-d'),
                        'start_time' => $time['start_time'],
                        'end_time' => $time['end_time'],
                        'price' => $time['price'],
                        'total_seats' => 50,
                        'available_seats' => 50
                    ]);
                }
            }
        }
        
        $this->command->info('Shows created successfully!');
    }
} 