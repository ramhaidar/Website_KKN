<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up ()
    {
        Schema::create ( 'admins', function (Blueprint $table)
        {
            $table->id ();
            // Add additional columns as needed
            $table->string ( column: 'nama' );
            $table->timestamps ();
        } );

        Schema::table ( 'users', function (Blueprint $table)
        {
            $table->unsignedBigInteger ( 'admin_id' )->nullable ();
            $table->foreign ( 'admin_id' )->references ( 'id' )->on ( 'admins' );
        } );
    }

    public function down ()
    {
        Schema::table ( 'users', function (Blueprint $table)
        {
            $table->dropForeign ( [ 'admin_id' ] );
            $table->dropColumn ( 'admin_id' );
        } );

        Schema::dropIfExists ( 'admins' );
    }
};
