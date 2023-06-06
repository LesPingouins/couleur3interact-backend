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
        Schema::create('setting_user', function (Blueprint $table) {
            $table->boolean('is_enable');
            $table->string('misc')->nullable();
            $table->boolean('is_active');
            $table->timestamps();
            $table->integer('setting_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->primary(['setting_id', 'user_id']);
            $table->foreign('setting_id')
                ->references('id')
                ->on('settings')
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
        Schema::dropIfExists('setting_user');
    }
};
