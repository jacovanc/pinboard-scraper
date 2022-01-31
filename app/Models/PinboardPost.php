<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PinboardPost extends Model
{
    use HasFactory;

	protected $fillable = ['url', 'title', 'description', 'tags'];

	protected $casts = [
        'tags' => 'array'
    ];

	//TODO: Add laravel/ui package dependency to readme: npm install && npm run dev

	public static function allWithTags($tags) {
		$data = DB::table('pinboard_posts')
			->whereJsonContains('tags', '[laravel]')
			->get();
		return $data;
	}
}
