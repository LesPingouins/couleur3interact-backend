<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("events")->insert([
            "name_of" => "Gagner 2 billets pour Disneyland Paris",
            "description" => "Tenter de remporter 2 billets pour Disneyland Paris en répondant à la question suivante",
            "question" => "Comment s'appelle l'acteur principal dans Spider-Man : No Way Home",
            "duration" => 1000000,
            "is_predefined" => false,
            "is_active"  => true,
            "type_id" => 2,
            "user_id" => 1,
            "created_at"  => Carbon::now(),
            "updated_at"  => Carbon::now(),
        ]);

        DB::table("events")->insert([
            "name_of" => "Gagner 1 billet pour le Paléo 2023",
            "description" => "Tenter de remporter 1 billet pour le prochain Paléo en répondant à la question suivante",
            "question" => "Qui à chanter : 'I will survive' ?",
            "duration" => 1000000,
            "is_predefined" => false,
            "is_active"  => true,
            "type_id" => 2,
            "user_id" => 1,
            "created_at"  => Carbon::now(),
            "updated_at"  => Carbon::now(),
        ]);
    }
}
