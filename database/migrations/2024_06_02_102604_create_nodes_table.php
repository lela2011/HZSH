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
        Schema::create('nodes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_en');
            $table->longText('body')->nullable();
            $table->longText('body_en')->nullable();
            $table->longText('info')->nullable();
            $table->longText('info_en')->nullable();
            $table->unsignedSmallInteger('order');
            $table->unsignedBigInteger('parent_id')->nullable();

            $table->foreign('parent_id')->references('id')->on('nodes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nodes');
    }
};
