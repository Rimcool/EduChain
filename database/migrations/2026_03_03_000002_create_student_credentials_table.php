<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_credentials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('student_name');
            $table->string('roll_number');
            $table->string('degree_title');
            $table->string('university_name');
            $table->string('graduation_year', 4);
            $table->string('degree_hash');
            $table->enum('status', ['verified','unconfirmed','fake']);
            $table->string('public_slug')->unique(); // ahmed-ali-fa19bcs001
            $table->string('verification_code');
            $table->integer('view_count')->default(0); // how many times badge viewed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_credentials');
    }
};