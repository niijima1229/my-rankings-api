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
        Schema::create('ranking_items', function (Blueprint $table) {
            $table->id();
			$table->foreignId('ranking_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
			$table->string('name');
			$table->unsignedTinyInteger('rank')->default(0);
			$table->integer('score')->default(0);
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
        Schema::dropIfExists('ranking_items');
    }
};
