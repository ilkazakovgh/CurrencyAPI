<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        DB::table('currency')->insert([
            'name' => Str::random(10),
            'rate' => random_int(10, 100),
        ]);*/

        Currency::factory()
            ->count(30)
            ->create();
    }
}
