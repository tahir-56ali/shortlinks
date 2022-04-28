<?php

namespace App\Jobs;

use App\ShortLink;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CrawlTitle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $shortLink;

    /**
     * Create a new job instance.
     *
     * @param ShortLink $shortLink
     */
    public function __construct(ShortLink $shortLink)
    {
        $this->shortLink = $shortLink;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $httpClient = new Client();
            $response = $httpClient->get($this->shortLink->link);
            $htmlString = (string)$response->getBody();
            //add this line to suppress any warnings
            libxml_use_internal_errors(true);
            $doc = new \DOMDocument();
            $doc->loadHTML($htmlString);
            $xpath = new \DOMXPath($doc);
            $title = $xpath->evaluate('//div[@class="mw-body"]/h1');
            $this->shortLink->title = $title[0]->textContent;
            $this->shortLink->save();
        } catch (GuzzleException $ex) {
            return "Error Occurred: ".$ex->getMessage();
        }
    }
}
