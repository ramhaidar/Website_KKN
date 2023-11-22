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
            $table->string ( 'nama_ketua' );
            $table->string ( 'nim' );
            $table->string ( 'prodi' );
            $table->string ( 'fakultas' );

            $table->unsignedBigInteger ( 'user_id' )->nullable ()->unique ();
            $table->foreign ( 'user_id' )->references ( 'id' )->on ( 'users' )->onDelete ( 'cascade' );

            $table->timestamps ();
        } );

        Schema::table ( 'users', function (Blueprint $table)
        {
            $table->unsignedBigInteger ( 'mahasiswa_id' )->nullable ()->unique ();
            $table->foreign ( 'mahasiswa_id' )->references ( 'id' )->on ( 'mahasiswas' )->onDelete ( 'cascade' );
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
