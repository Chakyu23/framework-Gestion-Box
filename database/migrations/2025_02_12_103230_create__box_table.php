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
        Schema::create('box_models', function (Blueprint $table) {
            $table->id();
            $table->string('name', length: 50);
            $table->float('surface');
            $table->float('height');
            $table->boolean('security');
            $table->boolean('refrigerate');
            $table->boolean('active');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('name', length: 50);
            $table->string('address', length: 150);
            $table->char('postalCode', length: 5);
            $table->string('telephone' , length: 15);
            $table->string('mail', length: 320);
            $table->boolean('active');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('box', function (Blueprint $table) {
            $table->id();
            $table->string('designation', length: 50);
            $table->float('prices');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('model_id')->references('id')->on('box_models');
            $table->foreignId('site_id')->references('id')->on('sites')->onDelete('cascade');
            $table->foreignId('locataire_id')->nullable()->references('id')->on('locataires')->onDelete('set null');
            $table->boolean('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('box_models');
        Schema::dropIfExists('sites');
        Schema::dropIfExists('box');
    }
};
