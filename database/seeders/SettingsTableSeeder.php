<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SettingsTableSeeder extends Seeder
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
        DB::table("settings")->insert([
            "name_of" => "Sondage",
            "slug" => "notif_poll",
            "is_active"  => 1,
            "created_at"  => $date,
            "updated_at"  => $date,
        ]);

        DB::table("settings")->insert([
            "name_of" => "Annonce",
            "slug" => "notif_announcement",
            "is_active"  => 1,
            "created_at"  => $date,
            "updated_at"  => $date,
        ]);

        DB::table("settings")->insert([
            "name_of" => "Concours",
            "slug" => "notif_contest",
            "is_active"  => 1,
            "created_at"  => $date,
            "updated_at"  => $date,
        ]);

        DB::table("settings")->insert([
            "name_of" => "Dark Mode",
            "slug" => "option_darkmode",
            "is_active"  => 1,
            "created_at"  => $date,
            "updated_at"  => $date,
        ]);
    }
}
