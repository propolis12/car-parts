<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->unique('registration_number');
        });

        Schema::table('parts', function (Blueprint $table) {
            $table->unique(['car_id','serialnumber']);
        });
    }

    public function down(): void
    {
        Schema::table('parts', function (Blueprint $table) {
            $table->dropUnique('parts_car_id_serialnumber_unique');
        });

        Schema::table('cars', function (Blueprint $table) {
            $table->dropUnique('cars_registration_number_unique');
        });
    }

};
