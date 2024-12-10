<?php

namespace Database\Seeders;

use App\Models\Control;
use App\Models\Implementation;
use App\Models\User;
use App\Models\Requirement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Crea un utente
        User::factory()->create([
            'name' => 'Walter',
            'surname' => 'White',
            'role' => 'user',
            'email' => 'utente@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1234'),
            'remember_token' => Str::random(10),
        ]);

        /*
                // controlli ufficiali
                $jsonRequirements = File::get("database/seeders/data/NIS2_requirements.json");
                $jsonNistControls = File::get("database/seeders/data/official/NIST_controls_official.json");
                $jsonIsoControls = File::get("database/seeders/data/official/ISO_controls_official.json");
                $jsonCisControls = File::get("database/seeders/data/official/CIS_controls_official.json");
                $jsonNistImplementations = File::get("database/seeders/data/NIST_implementations.json");
                $jsonCisImplementations = File::get("database/seeders/data/CIS_implementations.json");

                */

                // controlli lite
                $jsonRequirements = File::get("database/seeders/data/NIS2_requirements.json");
                $jsonNistControls = File::get("database/seeders/data/official/NIST_controls_official.json");
                $jsonIsoControls = File::get("database/seeders/data/official/ISO_controls_official.json");
                $jsonCisControls = File::get("database/seeders/data/lite/CIS_controls_lite.json");
                $jsonNistImplementations = File::get("database/seeders/data/NIST_implementations.json");
                $jsonCisImplementations = File::get("database/seeders/data/CIS_implementations.json");


        $requirements = json_decode($jsonRequirements);
        $nistControls = json_decode($jsonNistControls);
        $isoControls = json_decode($jsonIsoControls);
        $cisControls = json_decode($jsonCisControls);
        $nistImplementations = json_decode($jsonNistImplementations);
		$cisImplementations = json_decode($jsonCisImplementations);



        // Crea i requisiti NIS2
        foreach ($requirements as $key => $value) {
            Requirement::create([
                "name" => $value->name,
                "description" => $value->description,
                "article" => $value->article,
                "paragraph" => $value->paragraph,
                "letter" => $value->letter,
                "topic" => $value->topic,
            ]);
        }

        // Crea i controlli NIST
        foreach ($nistControls as $key => $value) {
            Control::create([
                "nis2_ref" => $value->nis2_ref,
                "framework" => $value->framework,
                "code" => $value->code,
                "priority" => $value->priority,
                "category" => $value->category,
                "sub_category" => $value->sub_category,
                "description" => $value->description,
                "function" => $value->function,
                "asset_type" => $value->asset_type,
            ]);
        }

        // Crea i controlli ISO
        foreach ($isoControls as $key => $value) {
            Control::create([
                "nis2_ref" => $value->nis2_ref,
                "framework" => $value->framework,
                "code" => $value->code,
                "priority" => $value->priority,
                "category" => $value->category,
                "sub_category" => $value->sub_category,
                "description" => $value->description,
                "function" => $value->function,
                "asset_type" => $value->asset_type,
            ]);
        }

        // Crea i controlli CIS
        foreach ($cisControls as $key => $value) {
            Control::create([
                "nis2_ref" => $value->nis2_ref,
                "framework" => $value->framework,
                "code" => $value->code,
                "priority" => $value->priority,
                "category" => $value->category,
                "sub_category" => $value->sub_category,
                "description" => $value->description,
                "function" => $value->function,
                "asset_type" => $value->asset_type,
            ]);
        }

        // Crea le implementazioni per i controlli NIST
        foreach ($nistImplementations as $key => $value) {
            Implementation::create([
                "code_ref" => $value->code_ref,
                "framework_ref" => $value->framework_ref,
                "implementation_text" => $value->implementation_text,
            ]);
        }

		// Crea le implementazioni per i controlli CIS
        foreach ($cisImplementations as $key => $value) {
            Implementation::create([
                "code_ref" => $value->code_ref,
                "framework_ref" => $value->framework_ref,
                "implementation_text" => $value->implementation_text,
            ]);
        }

        /*
            User::factory()
                ->count(5)
                ->create()
                ->each(function ($user) {

                    Control::factory()
                        ->count(10)
                        ->create(['user_id' => $user->id]);
                });
        */
    }
}
