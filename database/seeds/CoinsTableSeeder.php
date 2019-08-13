<?php

use App\Coin;
use Illuminate\Database\Seeder;

class CoinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();

        Coin::truncate();

        $coins = [
            [
                'phrase' => 'Be You',
                'number' => '0110A'
            ],
            [
                'phrase' => 'Be You',
                'number' => '0111A'
            ],
            [
                'phrase' => 'Be You',
                'number' => '0112A'
            ],
            [
                'phrase' => 'Be You',
                'number' => '0113A'
            ],
            [
                'phrase' => 'Be You',
                'number' => '0114A'
            ],
            [
                'phrase' => 'Be You',
                'number' => '0115A'
            ],
            [
                'phrase' => 'Be You',
                'number' => '0116A'
            ],
            [
                'phrase' => 'Be You',
                'number' => '0117A'
            ],
            [
                'phrase' => 'Be You',
                'number' => '0118A'
            ],
            [
                'phrase' => 'Be You',
                'number' => '0119A'
            ],
            [
                'phrase' => 'Be You',
                'number' => '0120A'
            ],
            [
                'phrase' => 'Thank You',
                'number' => '02054A'
            ],
            [
                'phrase' => 'Thank You',
                'number' => '02055A'
            ],
            [
                'phrase' => 'Thank You',
                'number' => '02056A'
            ],
            [
                'phrase' => 'Thank You',
                'number' => '02057A'
            ],
            [
                'phrase' => 'Thank You',
                'number' => '02058A'
            ],
            [
                'phrase' => 'Thank You',
                'number' => '02059A'
            ],
            [
                'phrase' => 'Thank You',
                'number' => '02060A'
            ]
        ];

        foreach ($coins as $coin) {
            Coin::create($coin);
        }

        Schema::enableForeignKeyConstraints();

    }
}
