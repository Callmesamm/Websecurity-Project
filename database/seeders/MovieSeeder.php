<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Movie;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = [
            [
                'title' => 'Inception',
                'storyline' => 'A thief who steals corporate secrets through dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O.',
                'image' => 'https://m.media-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_.jpg',
                'category' => 'Sci-Fi',
                'rating' => 8.8,
                'release_date' => '2010-07-16',
                'duration' => 148
            ],
            [
                'title' => 'The Dark Knight',
                'storyline' => 'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.',
                'image' => 'https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_.jpg',
                'category' => 'Action',
                'rating' => 9.0,
                'release_date' => '2008-07-18',
                'duration' => 152
            ],
            [
                'title' => 'The Shawshank Redemption',
                'storyline' => 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.',
                'image' => 'https://m.media-amazon.com/images/M/MV5BNDE3ODcxYzMtY2YzZC00NmNlLWJiNDMtZDViZWM2MzIxZDYwXkEyXkFqcGdeQXVyNjAwNDUxODI@._V1_.jpg',
                'category' => 'Drama',
                'rating' => 9.3,
                'release_date' => '1994-09-23',
                'duration' => 142
            ],
            [
                'title' => 'Pulp Fiction',
                'storyline' => 'The lives of two mob hitmen, a boxer, a gangster and his wife, and a pair of diner bandits intertwine in four tales of violence and redemption.',
                'image' => 'https://m.media-amazon.com/images/M/MV5BNGNhMDIzZTUtNTBlZi00MTRlLWFjM2ItYzViMjE3YzI5MjljXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_.jpg',
                'category' => 'Crime',
                'rating' => 8.9,
                'release_date' => '1994-10-14',
                'duration' => 154
            ],
            [
                'title' => 'The Matrix',
                'storyline' => 'A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.',
                'image' => 'https://m.media-amazon.com/images/M/MV5BNzQzOTk3OTAtNDQ0Zi00ZTVkLWI0MTEtMDllZjNkYzNjNTc4L2ltYWdlXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_.jpg',
                'category' => 'Sci-Fi',
                'rating' => 8.7,
                'release_date' => '1999-03-31',
                'duration' => 136
            ]
        ];

        foreach ($movies as $movie) {
            Movie::create($movie);
        }
    }
}
