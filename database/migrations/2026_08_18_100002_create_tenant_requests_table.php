<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenant_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('type');
            $table->string('subject');
            $table->text('body');
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('unit')->nullable();
            $table->string('preferred_contact')->default('email');
            $table->string('priority')->nullable();
            $table->boolean('permission_to_enter')->default(false);
            $table->string('status')->default('new');
            $table->text('internal_note')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenant_requests');
    }
};
