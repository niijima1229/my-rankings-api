<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ranking extends Model
{
    use HasFactory;

	protected $fillable = [
		'title',
		'user_id'
	];

	public function ranking_items(): HasMany
	{
		return $this->hasMany(RankingItem::class);
	}
}
