<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('student_name');
            $table->string('roll_number');
            $table->string('degree_title');
            $table->string('university_name');
            $table->string('graduation_year', 4);
            $table->string('degree_hash');
            $table->enum('result', ['real','fake','unconfirmed']);
            $table->integer('score')->default(0);
            $table->json('checks');          // array of layer results
            $table->string('reason');        // one line verdict
            $table->string('code')->unique(); // EDU-XXXXXX
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('verifications');
    }
};