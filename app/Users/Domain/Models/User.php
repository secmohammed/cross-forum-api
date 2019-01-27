<?php

namespace App\Users\Domain\Models;

use App\App\Domain\Traits\CanResetPassword;
use App\Forum\Domain\Models\Post;
use App\Forum\Domain\Models\Topic;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject {
	use Notifiable,CanResetPassword;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'username', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];
	public function avatar($size = 45) {
		return 'http://www.gravatar.com/avatar/' . md5($this->email) . '?s=' . $size . '&d=mm';
	}
	public function topics() {
		return $this->hasMany(Topic::class);
	}
	public function posts() {
		return $this->hasMany(Post::class);
	}

	/**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
	public function getJWTIdentifier()
	{
        return $this->getKey();
	}

	/**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
	public function getJWTCustomClaims()
	{
		return [];
	}
}
