<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Mahasiswa
 * 
 * @property int $id
 * @property string $nama_ketua
 * @property string|null $anggota_kelompok
 * @property string $nim
 * @property string $prodi
 * @property string $fakultas
 * @property int|null $dpl_id
 * @property int|null $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Dpl|null $dpl
 * @property User $user
 * @property Collection|Dpl[] $dpls
 * @property Collection|Laporan[] $laporans
 *
 * @package App\Models
 */
class Mahasiswa extends Model
{
	protected $table = 'mahasiswas';

	protected $casts = [ 
		'dpl_id'  => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [ 
		'nama_ketua',
		'anggota_kelompok',
		'nim',
		'prodi',
		'fakultas',
		'dpl_id',
		'user_id'
	];

	public function dpl ()
	{
		return $this->belongsTo ( Dpl::class);
	}

	public function user ()
	{
		return $this->hasOne ( User::class);
	}

	public function dpls ()
	{
		return $this->hasMany ( Dpl::class);
	}

	public function laporans ()
	{
		return $this->hasMany ( Laporan::class);
	}
}
