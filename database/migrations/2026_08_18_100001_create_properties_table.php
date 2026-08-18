<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address_line');
            $table->string('city');
            $table->string('state', 10);
            $table->string('postal_code', 20);
            $table->string('type')->default('Single Family Home');
            $table->string('image_path')->nullable();
            $table->string('manager_name');
            $table->string('manager_title')->default('Property Manager');
            $table->string('manager_email');
            $table->string('manager_phone');
            $table->string('office_hours')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
