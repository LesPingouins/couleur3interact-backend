<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TypesTableSeeder extends Seeder
{
    private function randDate()
    {
        $nbJours = rand(-2800, 0);
        return Carbon::now()->addDays($nbJours);
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = $this->randDate();
        DB::table("types")->insert([
            "name_of" => "Sondage",
            "slug" => "poll",
            "priority" => 2,
            "is_active"  => 1,
            "created_at"  => $date,
            "updated_at"  => $date,
        ]);

        DB::table("types")->insert([
            "name_of" => "Concours",
            "slug" => "contest",
            "priority" => 1,
            "is_active"  => 1,
            "created_at"  => $date,
            "updated_at"  => $date,
        ]);
    }
}
