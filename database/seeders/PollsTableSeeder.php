<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PollsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("events")->insert([
            "name_of" => "La musique actuelle",
            "question" => "Comment trouvez-vous la musique ?",
            "duration" => 1000000,
            "is_predefined" => false,
            "is_active"  => true,
            "type_id" => 1,
            "user_id" => 1,
            "created_at"  => Carbon::now(),
            "updated_at"  => Carbon::now(),
        ]);

        DB::table("events")->insert([
            "name_of" => "Type de musique préférée",
            "question" => "Quel est votre type de musique préférée ?",
            "duration" => 1000000,
            "is_predefined" => false,
            "is_active"  => true,
            "type_id" => 1,
            "user_id" => 1,
            "created_at"  => Carbon::now(),
            "updated_at"  => Carbon::now(),
        ]);

        DB::table("events")->insert([
            "name_of" => "Question rap",
            "question" => "Aimez-vous le rap ?",
            "duration" => 1000000,
            "is_predefined" => true,
            "is_active"  => true,
            "type_id" => 1,
            "user_id" => 1,
            "created_at"  => Carbon::now(),
            "updated_at"  => Carbon::now(),
        ]);

        DB::table("answers")->insert([
            "no" => "1",
            "name_of" => "Oui",
            "is_right_answer" => false,
            "is_active"  => true,
            "event_id" => 3,
            "user_id" => 1,
            "created_at"  => Carbon::now(),
            "updated_at"  => Carbon::now(),
        ]);

        DB::table("answers")->insert([
            "no" => "2",
            "name_of" => "Non",
            "is_right_answer" => false,
            "is_active"  => true,
            "event_id" => 3,
            "user_id" => 1,
            "created_at"  => Carbon::now(),
            "updated_at"  => Carbon::now(),
        ]);
    }
}
