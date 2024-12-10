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
        Schema::create('controls', function (Blueprint $table) {
            $table->id();
            $table->integer('nis2_ref');
            $table->string('framework');
            $table->string('code');
            $table->string('priority')->nullable();
            $table->string('category');
            $table->string('sub_category')->nullable();
            $table->text('description');
            $table->string('function')->nullable();
            $table->string('asset_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('controls');
    }
};
