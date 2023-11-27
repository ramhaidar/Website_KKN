<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up ()
    {
        // Create laporan_akhirs table
        Schema::create ( 'laporan_akhirs', function (Blueprint $table)
        {
            $table->id ();
            $table->unsignedBigInteger ( 'mahasiswa_id' )->unique ();
            $table->unsignedBigInteger ( 'dpl_id' )->unique ();
            $table->string ( 'revisi' )->nullable ();
            $table->boolean ( 'approved' )->default ( false );
            $table->string ( 'file_path' )->nullable ();
            $table->timestamps ();

            $table->foreign ( 'mahasiswa_id' )->references ( 'id' )->on ( 'mahasiswas' )->onDelete ( 'cascade' );
            $table->foreign ( 'dpl_id' )->references ( 'id' )->on ( 'dpls' )->onDelete ( 'cascade' );
        } );

        // Add laporan_akhir_id column to mahasiswas table
        Schema::table ( 'mahasiswas', function (Blueprint $table)
        {
            $table->unsignedBigInteger ( 'laporan_akhir_id' )->nullable ()->unique ()->after ( 'user_id' );
            $table->foreign ( 'laporan_akhir_id' )->references ( 'id' )->on ( 'laporan_akhirs' )->onDelete ( 'set null' );
        } );
    }

    public function down ()
    {
        // Drop foreign keys and columns
        Schema::table ( 'mahasiswas', function (Blueprint $table)
        {
            $table->dropForeign ( [ 'laporan_akhir_id' ] );
            $table->dropColumn ( 'laporan_akhir_id' );
        } );

        Schema::dropIfExists ( 'laporan_akhirs' );
    }
};
