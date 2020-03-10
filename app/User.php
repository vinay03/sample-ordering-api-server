<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class User extends Authenticatable
{
	use Notifiable;

	protected $fillable = [
		'name', 'email', 'password', 'role',
	];
	protected $hidden = [
		'password', 'remember_token',
	];
	protected $casts = [
		'id' => 'integer',
		'email_verified_at' => 'datetime',
	];

	static function add($data)
	{
		$data['password'] = Hash::make($data['password']);
		$data['api_token'] = Str::random(60);
		$user = new self;
		$user->fill($data);
		$user->save();
		return $user;
	}
}
