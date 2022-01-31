<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Factories\Administration\PinboardPostFactory;

class PinbardPostModelTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fetches_with_tags()
    {
		//This test was mainly to help debug this function, and is not written as a proper test.
		// $result = \App\Models\PinboardPost::all()->first();
		$result = \App\Models\PinboardPost::allWithTags(["laravel"]);
		dd($result);
    }
}
