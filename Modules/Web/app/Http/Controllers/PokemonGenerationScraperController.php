<?php

namespace Modules\Web\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Observers\Pokemon\PokemonGenerationScraperObserver;
use Illuminate\Http\Request;
use Spatie\Crawler\Crawler;

class PokemonGenerationScraperController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $url = "https://bulbapedia.bulbagarden.net/wiki/List_of_Pok%C3%A9mon_by_National_Pok%C3%A9dex_number";

        Crawler::create()
            ->setCrawlObserver(new PokemonGenerationScraperObserver())
            ->setMaximumDepth(0)
            ->setTotalCrawlLimit(1)
            ->startCrawling($url);
    }
}
