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
        Schema::create('cats', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('')->comment('Имя');
            $table->string('image')->nullable()->default('')->comment('Изображение');
            $table->integer('age')->comment('Возраст');
            $table->unsignedBigInteger('breed_id')->comment('Порода');

            $table->foreign('breed_id')->references('id')->on('breeds')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('cats');
    }
};
