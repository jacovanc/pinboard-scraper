<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PinboardScraperService;

class PinboardScraperCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pinboard:scrape';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrapes the provided Pinboard URL for links with the tags laravel/vue/php/api and saves to Database.'; // This could be extended to allow providing specific tags in the command.

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(PinboardScraperService $scraper)
    {
		$this->info('Scraping Pinboard...');
		// Run required scraper code
		$success = $scraper->scrapePinboard();
		if($success) {
			$this->info('Success!');
			return 1;
		}
		$this->info('Something went wrong'); // TODO: More verbose error message? 
		return 0;
    }
}
