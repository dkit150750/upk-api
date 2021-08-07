<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lectures', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('time', 20);
            $table->string('cabinet', 20)->nullable();
            $table->unsignedTinyInteger('places')->default(0);
            $table->unsignedTinyInteger('total_places')->default(16);
            $table->boolean('is_active')->default(true);
            $table->foreignId('course_id')->constrained();
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
        Schema::dropIfExists('lectures');
    }
}
