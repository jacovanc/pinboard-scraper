<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PinboardPost;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index() {
		return PostResource::collection(PinboardPost::all());
	}
	public function indexByTags($tags) {
		$tags = unserialize($tags);

		return PostResource::collection(PinboardPost::allWithTags($tags));
	}
}
