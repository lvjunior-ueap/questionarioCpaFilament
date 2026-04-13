<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call(DocenteSurvey2026Seeder::class);
        $this->call(TecnicoSurvey2026Seeder::class);
        $this->call(DiscenteSurvey2026Seeder::class);
        $this->call(ComunidadeExternaSurvey2026Seeder::class);
        $this->call(EgressoSurvey2026Seeder::class);
        $this->call(GestaoSurvey2026Seeder::class);
        $this->call(TransposicaoSurvey2026Seeder::class);
        $this->call(SystemUsersSeeder::class);
        $this->call(ResponsesSeeder::class);
    }
}
