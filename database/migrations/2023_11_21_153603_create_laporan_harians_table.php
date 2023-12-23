<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up ()
    {
        Schema::create ( 'laporan_harians', function (Blueprint $table)
        {
            $table->id ();
            $table->unsignedBigInteger ( 'mahasiswa_id' )->nullable();
            $table->unsignedBigInteger ( 'dpl_id' )->nullable();
            $table->string ( 'hari' );
            $table->date ( 'tanggal' );
            $table->string ( 'jenis_kegiatan' );
            $table->text ( 'tujuan' );
            $table->text ( 'sasaran' );
            $table->text ( 'hambatan' );
            $table->text ( 'solusi' )->nullable();
            $table->text ( 'tempat' );
            $table->string ( 'dokumentasi_path' ); // menyimpan path ke file dokumentasi
            $table->timestamps ();

            $table->foreign ( 'mahasiswa_id' )
                ->references ( 'id' )
                ->on ( 'mahasiswas' )
                ->onDelete ( 'set null' );
            $table->foreign ( 'dpl_id' )
                ->references ( 'id' )
                ->on ( 'dpls' )
                ->onDelete ( 'set null' );
        } );
    }

    public function down ()
    {
        Schema::table ( 'laporan_harians', function (Blueprint $table)
        {
            $table->dropForeign ( [ 'mahasiswa_id' ] );
            $table->dropForeign ( [ 'dpl_id' ] );
        } );

        Schema::dropIfExists ( 'laporan_harians' );
    }
};
