<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RankingItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ranking_items')->insert([
			[
				'ranking_id' => 1,
				'name' => '富士山',
				'rank' => 1,
				'score' => 3776
			],
			[
				'ranking_id' => 1,
				'name' => '北岳',
				'rank' => 2,
				'score' => 3193
			],
			[
				'ranking_id' => 1,
				'name' => '奥穂高岳',
				'rank' => 3,
				'score' => 3190
			],
		]);
    }
}
