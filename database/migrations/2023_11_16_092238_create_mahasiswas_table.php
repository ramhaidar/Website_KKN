<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up ()
    {
        Schema::create ( 'mahasiswas', function (Blueprint $table)
        {
            $table->id ();
            // Add additional columns as needed
            $table->string ( 'nama_ketua' );
            $table->string ( 'nim' );
            $table->string ( 'prodi' );
            $table->string ( 'fakultas' );
            $table->timestamps ();
        } );

        Schema::table ( 'users', function (Blueprint $table)
        {
            $table->unsignedBigInteger ( 'mahasiswa_id' )->nullable ();
            $table->foreign ( 'mahasiswa_id' )->references ( 'id' )->on ( 'mahasiswas' );
        } );
    }

    public function down ()
    {
        Schema::table ( 'users', function (Blueprint $table)
        {
            $table->dropForeign ( [ 'mahasiswa_id' ] );
            $table->dropColumn ( 'mahasiswa_id' );
        } );

        Schema::dropIfExists ( 'mahasiswas' );
    }
};
