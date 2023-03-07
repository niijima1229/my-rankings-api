<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankingItem extends Model
{
    use HasFactory;

	protected $fillable = [
		'ranking_id',
		'name',
		'rank',
		'score'
	];
}
