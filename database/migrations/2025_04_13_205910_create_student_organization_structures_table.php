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
        Schema::create('student_organization_structures', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_organizations_id')->index();
            $table->string('student_name', 255);
            $table->string('student_code', 50);
            $table->string('role', 100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_organization_structures');
    }
};
