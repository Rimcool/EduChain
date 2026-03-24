<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('issued_degrees', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->string('roll_number');
            $table->string('degree_title');
            $table->string('university_name');
            $table->string('graduation_year', 4);
            $table->string('degree_hash')->unique();
            $table->string('tx_hash')->nullable();
            $table->timestamp('issued_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('issued_degrees');
    }
};