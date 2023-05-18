<?php

namespace App\Console\Commands;

use App\Models\Anunciante;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class RegenerateAnunciantesSlugs extends Command
{
    protected $signature = 'anunciantes:regenerate-slugs';

    protected $description = 'Regenerate slugs for existing anunciantes';

    public function handle()
    {
        $anunciantes = Anunciante::all();

        foreach ($anunciantes as $anunciante) {
            $slug = Str::slug($anunciante->user->name); //gera o slug
            //verifica se o slug já existe no banco de dados
            if (Anunciante::where('slug', $slug)->exists()) {
                //se já existe, adiciona um número aleatório ao final
                $slug .= '-' . rand(1, 9999);
            }
            $anunciante->slug = $slug;
            $anunciante->save();
        }

        $this->info('Slugs regenerated for ' . count($anunciantes) . ' anunciantes.');
    }
}
