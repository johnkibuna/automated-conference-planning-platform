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
        Schema::create('conference_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conference_id')->constrained('conferences')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('speaker_id')->nullable()->constrained('speakers')->onDelete('set null');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('session_order')->default(0);
            $table->enum('status', ['scheduled', 'delayed', 'ongoing', 'completed'])->default('scheduled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conference_sessions');
    }
};
