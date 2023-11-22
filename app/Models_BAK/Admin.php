<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Admin
 * 
 * @property int $id
 * @property string $nama
 * @property int|null $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Admin extends Model
{
	protected $table = 'admins';

	protected $casts = [ 
		'user_id' => 'int'
	];

	protected $fillable = [ 
		'nama',
		'user_id'
	];

	public function user ()
	{
		return $this->hasOne ( User::class);
	}
}
