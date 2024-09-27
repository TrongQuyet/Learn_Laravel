<?php

namespace App\Observers\Pokemon;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Spatie\Crawler\CrawlObservers\CrawlObserver;
use Symfony\Component\DomCrawler\Crawler as DomCrawlerCrawler;

class PokemonGenerationScraperObserver extends CrawlObserver
{
    private $content;

    public function __construct()
    {
        $this->content = null;
    }

    public function willCrawl(UriInterface $url, ?string $linkText): void
    {
        Log::info('willCrawl', ['url' => $url]);
    }

    public function crawled(
        UriInterface $url,
        ResponseInterface $response,
        ?UriInterface $foundOnUrl = null,
        ?string $linkText = null,
    ): void {
        Log::info("Crawled: {$url}");

        $crawler = new DomCrawlerCrawler((string) $response->getBody());
        $genTableCrawler = $crawler->filter('h3')->reduce(function (DomCrawlerCrawler $node) {
            return str_contains($node->text(), 'Generation I');
        })->nextAll()->filter('table')->first();

        $pokemonData = collect($genTableCrawler->filter('tr')->each(function (DomCrawlerCrawler $tr, $i) {
            if (!$tr->filter('th')->count()) {
                return (object) [
                    'id' => $tr->filter('td')->eq(0)->text(),
                    'name' => $tr->filter('td')->eq(2)->text(),
                    'image' => $tr->filter('td img')->attr('src'),
                    'types' => $tr->filter('td')->eq(3)->filter('a')->text(),
                ];
            }
            return null;
        }))->filter()->values();
        \Log::info($pokemonData);
    }

    public function crawlFailed(
        UriInterface $url,
        RequestException $requestException,
        ?UriInterface $foundOnUrl = null,
        ?string $linkText = null,
    ): void {
        Log::error("Failed: {$url}");
    }


    public function finishedCrawling(): void
    {
        Log::info("Finished crawling");
    }
}
