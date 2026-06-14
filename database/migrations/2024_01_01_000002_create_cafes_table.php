<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cafes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address');
            $table->string('city');
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('wifi_quality')->nullable();   // good / medium / bad
            $table->string('power_outlet')->nullable();   // many / few / none
            $table->string('noise_level')->nullable();    // quiet / moderate / noisy
            $table->decimal('price_range_min', 10, 2)->default(0);
            $table->decimal('price_range_max', 10, 2)->default(0);
            $table->string('status')->default('active'); // active / inactive
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cafes');
    }
};
