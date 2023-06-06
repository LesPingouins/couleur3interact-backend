<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
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
        DB::table("roles")->insert([
            "name_of" => "Administrateur",
            "slug" => "admin",
            "is_active"  => 1,
            "created_at"  => $date,
            "updated_at"  => $date,
        ]);

        DB::table("roles")->insert([
            "name_of" => "Utilisateur",
            "slug" => "user",
            "is_active"  => 1,
            "created_at"  => $date,
            "updated_at"  => $date,
        ]);

        DB::table("roles")->insert([
            "name_of" => "Modérateur",
            "slug" => "moderator",
            "is_active"  => 1,
            "created_at"  => $date,
            "updated_at"  => $date,
        ]);
    }
}
