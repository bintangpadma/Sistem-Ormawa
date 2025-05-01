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
        Schema::create('student_activity_unit_programs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_activity_units_id')->index();
            $table->text('image_path')->nullable();
            $table->longText('name');
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_activity_unit_programs');
    }
};
