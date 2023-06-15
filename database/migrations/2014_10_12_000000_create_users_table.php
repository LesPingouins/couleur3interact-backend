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
        Schema::create('users', function (Blueprint $table) {
            $table->increments("id");
            $table->string('username')->unique();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('password')->nullable();
            $table->string('image')->nullable();
            $table->string('address')->nullable();
            $table->string('address_code')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->string('misc')->nullable();
            $table->boolean('is_active');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
