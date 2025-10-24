<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('parts', function (Blueprint $table) {
            $table->index('car_id');

            $table->dropUnique('parts_car_id_serialnumber_unique');

            $table->unique('serialnumber');
        });
    }

    public function down(): void
    {
        Schema::table('parts', function (Blueprint $table) {
            $table->dropUnique('parts_serialnumber_unique');
            $table->unique(['car_id', 'serialnumber']);
        });
    }
};
