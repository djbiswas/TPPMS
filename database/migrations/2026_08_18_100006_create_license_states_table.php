<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('license_states', function (Blueprint $table) {
            $table->id();
            $table->boolean('valid')->default(false);
            $table->string('status')->nullable();
            $table->string('message')->nullable();
            $table->string('expires')->nullable();
            $table->timestamp('checked_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('license_states');
    }
};
