<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('polls', function (Blueprint $table) {
            $table->increments("id");
            $table->string("name_of")->unique();
            $table->string("description")->nullable();
            $table->string("image")->nullable();
            $table->string("question");
            $table->integer("duration");
            $table->boolean('is_predefined');
            $table->integer("misc")->nullable();
            $table->boolean('is_active');
            $table->timestamps();
            $table->integer('type_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('type_id')
                ->references('id')
                ->on('types')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polls');
    }
};
