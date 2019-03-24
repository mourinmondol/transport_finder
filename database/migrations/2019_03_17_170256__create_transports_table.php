<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transport_name');
            $table->string('transport_type');
            $table->string('transport_image')->nullable();
            $table->text('transport_description')->nullable();
            $table->unsignedInteger('transport_likes')->nullable();
            $table->unsignedInteger('transport_dislikes')->nullable();
            $table->unsignedInteger('transport_status')->nullable();
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
