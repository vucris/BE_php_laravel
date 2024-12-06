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
        Schema::create('nhap_khos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_san_pham');
            $table->integer('id_dai_ly');
            $table->integer('so_luong')->default(1);
            $table->integer('don_gia')->default(0);
            $table->integer('thanh_tien')->default(0);
            $table->integer('trang_thai')->default(0);
            $table->text('ghi_chu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhap_khos');
    }
};
