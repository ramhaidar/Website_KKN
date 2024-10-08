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
 * @property int|null $laporan_akhir_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Dpl $dpl
 * @property LaporanAkhir|null $laporan_akhir
 * @property User $user
 * @property Collection|LaporanAkhir[] $laporan_akhirs
 * @property Collection|LaporanHarian[] $laporan_harians
 *
 * @package App\Models
 */
class Mahasiswa extends Model
{
	protected $table = 'mahasiswas';

	protected $casts = [
		'dpl_id' => 'int',
		'user_id' => 'int',
		'laporan_akhir_id' => 'int'
	];

	protected $fillable = [
		'nama_ketua',
		'anggota_kelompok',
		'nim',
		'prodi',
		'fakultas',
		'dpl_id',
		'user_id',
		'laporan_akhir_id'
	];

	public function dpl()
	{
		return $this->hasOne(Dpl::class);
	}

	public function laporan_akhir()
	{
		return $this->belongsTo(LaporanAkhir::class);
	}

	public function user()
	{
		return $this->hasOne(User::class);
	}

	public function laporan_akhirs()
	{
		return $this->hasMany(LaporanAkhir::class);
	}

	public function laporan_harians()
	{
		return $this->hasMany(LaporanHarian::class);
	}
}
