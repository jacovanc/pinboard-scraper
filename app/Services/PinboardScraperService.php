<?php

namespace App\Services;

use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\PinboardPost;

class PinboardScraperService
{

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

		// Delete all rows in Database (I have made the assumption that we simply always want this table up-to-date of the current page data. If we want to keep a record of old posts, we could check for changes and new data and update accordingly)
		PinboardPost::truncate();

		// Loop through every .display class Div (wrapper of each post)
		$crawler->filter('#bookmarks .display')->each(function($node) {
			$subCrawler = $node->children();

			//Fetch Title data
			$titleNode = $subCrawler->filter('.bookmark_title');
			$title = $titleNode->count() > 0 ? $titleNode->text() : null;
			$url = $titleNode->count() > 0 ? $titleNode->attr('href') : null;
			$subCrawler->closest('#bookmarks .display');

			// Fetch description data
			$descriptionNode = $subCrawler->filter('.description');
			$description = $descriptionNode->count() > 0 ? $descriptionNode->text() : null;

			// TODO: CHECK IF TITLE CONTAINS ONE OF THE TAGS: laravel, vue, php or api - only save if it does
			// Fetch tags data
			$tags = Array();
			$match = false; // Set to true when correct tag is found
			$subCrawler->filter('.tag')->each(function($node) use (&$tags, &$match) {
				$trimmed_tag = trim($node->text());
				if(in_array($trimmed_tag, ["laravel", "vue", "php", "api"])) {
					$match = true;
					$tags[] = $trimmed_tag; // Save every tag into an array
				}
			});
			$tags = json_encode($tags); // Convert to JSON for saving to Database

			// Debug
			// print "URL: " . $url . "\n";
			// print "Title: " . $title . "\n";
			// print "Description: " . $description . "\n";
			// print "Tags: " . $tags . "\n";

			// Save to DB
			if($match) {
				PinboardPost::create([
					'url' => $url,
					'title' => $title,
					'description' => $description,
					'tags' => $tags
				]);
			}
		});

		return true;
	}
}
