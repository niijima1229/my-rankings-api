<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RankingTest extends TestCase
{
	use RefreshDatabase, WithFaker;
	/**
	 * A basic feature test example.
	 *
	 * @return void
	 * バリデートが機能するか失敗する時のテストも書くべき？
	 */
	public function test_create_ranking()
	{
		$this->seed();
		$user = User::factory()->create();

		$data = [
			'title' => $this->faker->sentence,
			'rankingItems' => [
				$this->faker->sentence,
				$this->faker->sentence,
				$this->faker->sentence,
			]
		];
		$response = $this->actingAs($user)->post('/api/rankings/create', $data);

		$response->assertStatus(200);
	}
}
