<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up ()
    {
        Schema::create ( 'dpls', function (Blueprint $table)
        {
            $table->id ();
            // Add additional columns as needed
            $table->string ( 'nama_dosen' );
            $table->string ( 'nip' );
            $table->string ( 'prodi' );
            $table->string ( 'fakultas' );
            $table->timestamps ();
        } );

        Schema::table ( 'users', function (Blueprint $table)
        {
            $table->unsignedBigInteger ( 'dpl_id' )->nullable ();
            $table->foreign ( 'dpl_id' )->references ( 'id' )->on ( 'dpls' );
        } );
    }

    public function down ()
    {
        Schema::table ( 'users', function (Blueprint $table)
        {
            $table->dropForeign ( [ 'dpl_id' ] );
            $table->dropColumn ( 'dpl_id' );
        } );

        Schema::dropIfExists ( 'dpls' );
    }
};
