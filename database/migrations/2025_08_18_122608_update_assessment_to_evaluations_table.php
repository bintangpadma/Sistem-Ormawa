<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->enum('assessment', ['excellent', 'good', 'poor', 'very_poor', 'active', 'less active', 'inactive'])->change();
        });

        \Illuminate\Support\Facades\DB::table('evaluations')->where('assessment', 'excellent')->update(['assessment' => 'active']);
        \Illuminate\Support\Facades\DB::table('evaluations')->where('assessment', 'good')->update(['assessment' => 'active']);
        \Illuminate\Support\Facades\DB::table('evaluations')->where('assessment', 'poor')->update(['assessment' => 'less active']);
        \Illuminate\Support\Facades\DB::table('evaluations')->where('assessment', 'very_poor')->update(['assessment' => 'inactive']);

        Schema::table('evaluations', function (Blueprint $table) {
            $table->enum('assessment', ['active', 'less active', 'inactive'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->enum('assessment', ['excellent', 'good', 'poor', 'very_poor', 'active', 'less active', 'inactive'])->change();
        });

        \Illuminate\Support\Facades\DB::table('evaluations')->where('assessment', 'active')->update(['assessment' => 'excellent']);
        \Illuminate\Support\Facades\DB::table('evaluations')->where('assessment', 'less active')->update(['assessment' => 'poor']);
        \Illuminate\Support\Facades\DB::table('evaluations')->where('assessment', 'inactive')->update(['assessment' => 'very_poor']);

        Schema::table('evaluations', function (Blueprint $table) {
            $table->enum('assessment', ['excellent', 'good', 'poor', 'very_poor'])->change();
        });
    }
};
