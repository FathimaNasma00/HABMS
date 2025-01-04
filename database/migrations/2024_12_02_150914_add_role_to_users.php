<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('patient')->after('email');
            $table->unsignedBigInteger('specialtie_id')->nullable();
            $table->string('mobile_number')->after('email')->nullable();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
            $table->dropColumn('specialtie_id');
            $table->dropColumn('mobile_number');
            $table->dropSoftDeletes();
        });
    }
};
