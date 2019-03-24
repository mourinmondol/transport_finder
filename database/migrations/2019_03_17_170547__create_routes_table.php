<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('route_SSID');
            $table->unsignedInteger('route_DSID');
            $table->unsignedInteger('route_TID');
            $table->float('route_fare')->nullable();
            $table->float('route_distance')->nullable();
            $table->text('route_description')->nullable();
            $table->unsignedInteger('route_likes')->nullable();
            $table->unsignedInteger('route_dislikes')->nullable();
            $table->unsignedInteger('route_status')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
