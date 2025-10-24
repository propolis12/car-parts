<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up(): void
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained('cars')->cascadeOnDelete();
            $table->string('name');
            $table->string('serialnumber')->unique();
            $table->timestamps();


            $table->index('name');
            $table->index('serialnumber');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('parts');
    }
};
