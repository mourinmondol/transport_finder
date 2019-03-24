<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('station_name');
            $table->string('station_type');
            $table->string('station_image')->nullable();
            $table->float('station_lat')->nullable();
            $table->float('station_long')->nullable();
            $table->text('station_description')->nullable();
            $table->unsignedInteger('station_likes')->nullable();
            $table->unsignedInteger('station_dislikes')->nullable();
            $table->unsignedInteger('station_status')->nullable();
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
