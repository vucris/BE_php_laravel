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
        Schema::table('dai_lys', function (Blueprint $table) {
            $table->string('hash_reset')->nullable();
            $table->string('hash_active')->nullable();
            $table->string('is_block')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dailys', function (Blueprint $table) {
            //
        });
    }
};
