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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();

            // Ownership
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();

            // core
            $table->string('slug')->unique()->index();
            $table->string('name')->index();
            $table->text('description')->nullable();

            // contact
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            
            // Organization
            $table->string('organization_type')->nullable();
            $table->string('industry')->nullable();
            
            $table->boolean('is_verified')->default(false);
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->softDeletes();

            // files
            $table->string('logo')->nullable();
            $table->string('cover_image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
