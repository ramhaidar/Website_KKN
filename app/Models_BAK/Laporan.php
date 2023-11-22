<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Laporan
 * 
 * @property int $id
 * @property int $mahasiswa_id
 * @property string $hari
 * @property Carbon $tanggal
 * @property string $jenis_kegiatan
 * @property string $tujuan
 * @property string $sasaran
 * @property string $hambatan
 * @property string $solusi
 * @property string $dokumentasi_path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Mahasiswa $mahasiswa
 *
 * @package App\Models
 */
class Laporan extends Model
{
	protected $table = 'laporans';

	protected $casts = [ 
		'mahasiswa_id' => 'int',
		'tanggal'      => 'datetime'
	];

	protected $fillable = [ 
		'mahasiswa_id',
		'hari',
		'tanggal',
		'jenis_kegiatan',
		'tujuan',
		'sasaran',
		'hambatan',
		'solusi',
		'dokumentasi_path'
	];

	public function mahasiswa ()
	{
		return $this->belongsTo ( Mahasiswa::class);
	}

	public function getTanggalAttribute ( $value )
	{
		return Carbon::parse ( $value )->format ( 'Y-m-d' );
	}

}
