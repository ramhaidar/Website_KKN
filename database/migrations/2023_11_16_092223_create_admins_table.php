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
            $table->string ( column: 'nama' );

            $table->unsignedBigInteger ( 'user_id' )->nullable ()->unique ();
            $table->foreign ( 'user_id' )->references ( 'id' )->on ( 'users' );

            $table->timestamps ();
        } );

        Schema::table ( 'users', function (Blueprint $table)
        {
            $table->unsignedBigInteger ( 'admin_id' )->nullable ()->unique ();
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
