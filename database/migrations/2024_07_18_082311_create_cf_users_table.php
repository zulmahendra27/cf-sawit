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
        Schema::create('cf_users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('symptom_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('consultation_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->double('cfuser');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cf_users');
    }
};
