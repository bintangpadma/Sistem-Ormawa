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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->text('profile_path')->nullable();
            $table->string('lecturer_code', 50);
            $table->string('full_name', 255);
            $table->string('phone_number', 15);
            $table->string('gender', 25);
            $table->integer('status')->default(1);
            $table->integer('is_super_admin')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
