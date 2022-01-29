<?php

namespace App\Services;

use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;

class PinboardScraperService
{

	protected $tags = Array();

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
		//
    }

	/**
     * Create crawler for a given URL
     *
     * @return Crawler
	*/
    private function scrapeURL($url) {
		// TODO: Add to readme dependency for goutte package
		$client = new Client(HttpClient::create(['timeout' => 60]));
		$crawler = $client->request('GET', $url);

		return $crawler;
	}
	/**
     * Scrape the pinboard URL and save results to the pinboard_posts Database
     *
     * @return Boolean
	*/
	public function scrapePinboard() {
		$crawler = $this->scrapeURL("https://pinboard.in/u:alasdairw?per_page=120");

		// Loop through every .display class Div (wrapper of each post)
		$crawler->filter('#bookmarks .display')->each(function($node) {
			$subCrawler = $node->children();

			//Fetch Title data
			$titleNode = $subCrawler->filter('.bookmark_title');
			$title = $titleNode->count() > 0 ? $titleNode->text() : null;
			$subCrawler->closest('#bookmarks .display');

			// Fetch description data
			$descriptionNode = $subCrawler->filter('.description');
			$description = $descriptionNode->count() > 0 ? $descriptionNode->text() : null;

			// Fetch tags data
			$tags = Array();
			$subCrawler->filter('.tag')->each(function($node) use (&$tags) {
				$tags[] = $node->text(); // Save every tag into an array
			});
			$tags = json_encode($tags); // Convert to JSON for saving to Database

			// TODO: Save to database
			print $title . "\n";
			print $description . "\n";
			print $tags . "\n";
		
		});

		return true; // TODO: Define fail case too?
	}
}
