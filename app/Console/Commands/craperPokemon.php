<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Web\Http\Controllers\PokemonGenerationScraperController;

class craperPokemon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:craper-pokemon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        (new PokemonGenerationScraperController)->__invoke(request());
    }
}
