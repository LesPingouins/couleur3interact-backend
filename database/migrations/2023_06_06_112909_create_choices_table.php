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
        Schema::create('choices', function (Blueprint $table) {
            $table->increments("id");
            $table->boolean('is_right_choice');
            $table->string("misc")->nullable();
            $table->boolean('is_active');
            $table->timestamps();
            $table->integer('answer_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('answer_id')
                ->references('id')
                ->on('answers')
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
        Schema::dropIfExists('choices');
    }
};
