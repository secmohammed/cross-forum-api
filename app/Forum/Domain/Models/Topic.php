<?php

namespace App\Forum\Domain\Models;

use App\App\Domain\Traits\FetchLatest;
use App\Users\Domain\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model {
	use FetchLatest;
	protected $fillable = ['title', 'slug', 'body', 'section_id', 'user_id'];
	public function user() {
		return $this->belongsTo(User::class);
	}
	public function section() {
		return $this->belongsTo(Section::class);
	}
	public function posts() {
		return $this->hasMany(Post::class);
	}
}
