<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
		$user = User::factory()->make();
		$email = $user->email;
		$password = $user->password;

		$credentials = [
			'email' => $email,
			'password' => $password,
		];

		$token = Auth::attempt($credentials);

		$data = [
			'title' => $this->faker->sentence,
			'rankingItem' => [
				$this->faker->sentence,
				$this->faker->sentence,
				$this->faker->sentence,
			]
		];
		$response = $this->post('/api/ranking/create', $data);

		$response->assertStatus(200);
	}
}
