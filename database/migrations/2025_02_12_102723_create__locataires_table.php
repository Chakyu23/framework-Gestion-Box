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
        Schema::create('locataires', function (Blueprint $table) {
            $table->id();
            $table->string('firstname', length: 50);
            $table->string('lastname', length: 50);
            $table->string('telephone', length: 15);
            $table->string('mail', length: 320);
            $table->char('IBAN', length: 32);
            $table->string('adresse', length: 150);
            $table->string('city', length: 50);
            $table->char('postalCode', length: 5);
            $table->boolean('active');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locataires');
    }
};
