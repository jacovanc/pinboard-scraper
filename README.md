## Database
Uses Mysql (but should work fine with equivalent DB).
Ensure that you create a new Database named "pinboard_scraper" with basic root user (no password)
Update .env file DB_DATABASE setting to "pinboard_scraper"

## Dependencies
Uses composer and npm for package management - ensure both are installed.

Ensure that your dev environment has Mix installed:
> npm install laravel-mix --save-dev

Build and run the frontend (may not be necessary unless making changes to frontend code):
> npm install && npm dev

Install composer dependencies:
> composer install

Run laravel:
> php artisan serve

## Command 
The pinboard scraper command can be run with: 
> php pinboard:scraper