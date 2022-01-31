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

	public static function allWithTags($tags) {
		$data = DB::table('pinboard_posts')
			->whereJsonContains('tags', '[laravel]')
			->get();
		return $data;
	}
}
