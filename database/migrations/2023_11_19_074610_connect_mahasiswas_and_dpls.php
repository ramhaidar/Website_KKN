<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up ()
    {
        // 1. Tambahkan kolom "anggota_kelompok" berbentuk longtext di tabel mahasiswas
        Schema::table ( 'mahasiswas', function (Blueprint $table)
        {
            $table->longText ( 'anggota_kelompok' )->nullable ()->after ( 'nama_ketua' );
        } );

        // 2. Tiap satu objek mahasiswa merujuk kepada satu dosen pembimbing lapangan dan juga sebaliknya
        Schema::table ( 'mahasiswas', function (Blueprint $table)
        {
            $table->unsignedBigInteger ( 'dpl_id' )->nullable ()->unique ()->after ( 'fakultas' );
            $table->foreign ( 'dpl_id' )->references ( 'id' )->on ( 'dpls' )->onDelete ( 'set null' );
        } );

        Schema::table ( 'dpls', function (Blueprint $table)
        {
            $table->unsignedBigInteger ( 'mahasiswa_id' )->nullable ()->unique ()->after ( 'fakultas' );
            $table->foreign ( 'mahasiswa_id' )->references ( 'id' )->on ( 'mahasiswas' )->onDelete ( 'set null' );
        } );
    }

    public function down ()
    {
        Schema::table ( 'mahasiswas', function (Blueprint $table)
        {
            $table->dropForeign ( [ 'dpl_id' ] );
            $table->dropColumn ( 'dpl_id' );
            $table->dropColumn ( 'anggota_kelompok' );
        } );

        Schema::table ( 'dpls', function (Blueprint $table)
        {
            $table->dropForeign ( [ 'mahasiswa_id' ] );
            $table->dropColumn ( 'mahasiswa_id' );
        } );
    }
};
