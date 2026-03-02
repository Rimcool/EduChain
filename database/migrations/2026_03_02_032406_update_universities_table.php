<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('universities', function (Blueprint $table) {
            $table->string('category')->nullable()->after('name');
            $table->string('sector')->nullable()->after('category');
            $table->string('province')->nullable()->after('sector');
            $table->string('city')->nullable()->after('province');
            $table->integer('established_since')->nullable()->after('city');
            $table->boolean('is_hec_recognized')->default(true)->after('established_since');
            $table->boolean('is_blacklisted')->default(false)->after('is_hec_recognized');
            $table->boolean('is_on_educhain')->default(false)->after('is_blacklisted');
            $table->string('registrar_email')->nullable()->after('is_on_educhain');
            $table->string('registrar_phone')->nullable()->after('registrar_email');
        });
    }

    public function down(): void
    {
        Schema::table('universities', function (Blueprint $table) {
            $table->dropColumn([
                'category',
                'sector',
                'province',
                'city',
                'established_since',
                'is_hec_recognized',
                'is_blacklisted',
                'is_on_educhain',
                'registrar_email',
                'registrar_phone'
            ]);
        });
    }
};