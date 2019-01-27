<?php

namespace App\Forum\Domain\Models;

use App\Users\Domain\Models\User;
use Illuminate\Database\Eloquent\Model;

class Section extends Model {
    protected $fillable = ['title','description','slug'];
	public function user() {
		return $this->belongsTo(User::class);
	}
	public function topics() {
		return $this->hasMany(Topic::class);
	}
}
