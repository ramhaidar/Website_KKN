<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LaporanAkhir
 * 
 * @property int $id
 * @property int $mahasiswa_id
 * @property string $file_path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Mahasiswa $mahasiswa
 *
 * @package App\Models
 */
class LaporanAkhir extends Model
{
	protected $table = 'laporan_akhirs';

	protected $casts = [
		'mahasiswa_id' => 'int'
	];

	protected $fillable = [
		'mahasiswa_id',
		'file_path'
	];

	public function mahasiswa()
	{
		return $this->hasOne(Mahasiswa::class);
	}
}
