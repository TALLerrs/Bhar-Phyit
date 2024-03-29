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
        Schema::create('bhar_phyit_error_log_details', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('bhar_phyit_error_log_id');
            $table->jsonb('payload');
            $table->jsonb('queries')->nullable();
            $table->jsonb('headers')->nullable();
            $table->string('user_id')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bhar_phyit_error_log_details');
    }
};
