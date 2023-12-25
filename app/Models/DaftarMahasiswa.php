<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DaftarMahasiswa
 * 
 * @property int $id
 * @property string $nama
 * @property string $nim
 * @property string $fakultas
 * @property string $prodi
 * @property string $periode
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class DaftarMahasiswa extends Model
{
	protected $table = 'daftar_mahasiswa';

	protected $fillable = [
		'nama',
		'nim',
		'fakultas',
		'prodi',
		'periode'
	];
}
