<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->boolean('is_other')->default(false);
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('age')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('status')->default('pending');
            $table->decimal('amount', 12,2)->nullable();
            $table->timestamp('reminder_send_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
