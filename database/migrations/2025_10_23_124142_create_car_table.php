<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('registration_number')->nullable()->unique();
            $table->boolean('is_registered')->default(false)->index();
            $table->timestamps();


            $table->index('name');
        });


        try {
            DB::statement("ALTER TABLE cars ADD CONSTRAINT chk_cars_registration_required CHECK ((is_registered = 0) OR (registration_number IS NOT NULL AND registration_number <> ''))");
        } catch (\Throwable $e) {
        }
    }


    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
