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
        Schema::create('degrees', function (Blueprint $table) {
          // database/migrations/xxxx_create_degrees_table.php

$table->id();
$table->foreignId('user_id')->constrained();  // student
$table->foreignId('university_id')->constrained();
$table->string('title');  // e.g., BSc Computer Science
$table->date('issued_on');
$table->string('blockchain_hash')->nullable(); // from smart contract
$table->timestamps();
$table->string('status')->default('pending'); // e.g., pending, issued, revoked
$table->text('description')->nullable(); // Optional description of the degree
$table->string('certificate_file')->nullable(); // Optional file path for the degree certificate
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('degrees');
    }
};
