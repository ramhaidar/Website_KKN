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
 * @property string $nim
 * @property string $prodi
 * @property string $fakultas
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Mahasiswa extends Model
{
	protected $table = 'mahasiswas';

	protected $fillable = [
		'nama_ketua',
		'nim',
		'prodi',
		'fakultas'
	];

	public function users()
	{
		return $this->hasMany(User::class);
	}
}
