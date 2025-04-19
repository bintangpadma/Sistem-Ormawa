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
        Schema::create('event_recruitments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('events_id')->index();
            $table->bigInteger('event_divisions_id')->index();
            $table->string('student_name', 255);
            $table->string('student_code', 50);
            $table->string('number_phone', 15);
            $table->string('study_program', 50);
            $table->string('class', 25);
            $table->string('year_appointment', 4);
            $table->text('reason');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_recruitments');
    }
};
