<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('error_system', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('error_id');
            $table->foreign('error_id')->references('id')->on('errors')->onDelete('cascade');
            

            $table->unsignedBigInteger('system_id');
            $table->foreign('system_id')->references('id')->on('systems');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('error_system');
    }
};
