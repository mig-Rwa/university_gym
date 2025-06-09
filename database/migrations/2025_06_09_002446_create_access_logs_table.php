<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessLogsTable extends Migration
{
    public function up(): void
    {
        Schema::create('access_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamp('accessed_at');
            $table->string('access_point')->nullable(); // Optional: e.g. "Main Door"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('access_logs');
    }
}
