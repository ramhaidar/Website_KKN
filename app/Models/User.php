<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * 
 * @property int $id
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $admin_id
 * @property int|null $mahasiswa_id
 * @property int|null $dpl_id
 * 
 * @property Admin|null $admin
 * @property Dpl|null $dpl
 * @property Mahasiswa|null $mahasiswa
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	protected $table = 'users';

	protected $casts = [ 
		'email_verified_at' => 'datetime',
		'admin_id'          => 'int',
		'mahasiswa_id'      => 'int',
		'dpl_id'            => 'int'
	];

	protected $hidden = [ 
		'password',
		'remember_token'
	];

	protected $fillable = [ 
		'email',
		'email_verified_at',
		'password',
		'remember_token',
		'admin_id',
		'mahasiswa_id',
		'dpl_id'
	];

	public function admin ()
	{
		return $this->belongsTo ( Admin::class);
	}

	public function dpl ()
	{
		return $this->belongsTo ( Dpl::class);
	}

	public function mahasiswa ()
	{
		return $this->belongsTo ( Mahasiswa::class);
	}
}
