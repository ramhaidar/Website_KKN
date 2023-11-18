<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DPL
 * 
 * @property int $id
 * @property string $nama_dosen
 * @property string $nip
 * @property string $prodi
 * @property string $fakultas
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class DPL extends Model
{
	protected $table = 'dpls';

	protected $fillable = [ 
		'nama_dosen',
		'nip',
		'prodi',
		'fakultas'
	];

	public function users ()
	{
		return $this->hasMany ( User::class);
	}
}
