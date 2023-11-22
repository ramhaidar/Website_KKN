<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Dpl
 * 
 * @property int $id
 * @property string $nama_dosen
 * @property string $nip
 * @property string $prodi
 * @property string $fakultas
 * @property int|null $mahasiswa_id
 * @property int|null $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Mahasiswa|null $mahasiswa
 * @property User $user
 * @property Collection|Mahasiswa[] $mahasiswas
 *
 * @package App\Models
 */
class Dpl extends Model
{
	protected $table = 'dpls';

	protected $casts = [ 
		'mahasiswa_id' => 'int',
		'user_id'      => 'int'
	];

	protected $fillable = [ 
		'nama_dosen',
		'nip',
		'prodi',
		'fakultas',
		'mahasiswa_id',
		'user_id'
	];

	public function mahasiswa ()
	{
		return $this->belongsTo ( Mahasiswa::class);
	}

	public function user ()
	{
		return $this->hasOne ( User::class);
	}

	public function mahasiswas ()
	{
		return $this->hasMany ( Mahasiswa::class);
	}
}
