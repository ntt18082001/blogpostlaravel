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
            $table->id();
            $table->string('full_name', 50);
            $table->string('username', 50);
            $table->string('email', 30)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 200);
            $table->string('phone_number', 20);
            $table->string('address', 100)->nullable();
            $table->boolean('gender')->nullable();
            $table->string('avatar', 200)->nullable();
            $table->dateTime('birth_day')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
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
