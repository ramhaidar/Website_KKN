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
 * @property int $dpl_id
 * @property string|null $revisi
 * @property bool $approved
 * @property string $file_path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Dpl $dpl
 * @property Mahasiswa $mahasiswa
 *
 * @package App\Models
 */
class LaporanAkhir extends Model
{
	protected $table = 'laporan_akhirs';

	protected $casts = [
		'mahasiswa_id' => 'int',
		'dpl_id' => 'int',
		'approved' => 'bool'
	];

	protected $fillable = [
		'mahasiswa_id',
		'dpl_id',
		'revisi',
		'approved',
		'file_path'
	];

	public function dpl()
	{
		return $this->belongsTo(Dpl::class);
	}

	public function mahasiswa()
	{
		return $this->hasOne(Mahasiswa::class);
	}
}
