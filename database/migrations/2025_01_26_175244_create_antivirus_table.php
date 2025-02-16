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
        Schema::create('Antivirus', function (Blueprint $table) {
            $table->id();
            $table->timestamp('time')->nullable();  // Log timestamp
            $table->string('ip_src')->nullable();   // Source IP (Renamed ip.src -> ip_src)
            $table->string('username')->nullable(); // Username
            $table->string('host_dst')->nullable(); // Destination host (Renamed host.dst -> host_dst)
            $table->text('event_desc')->nullable(); // Event description (Renamed event.desc -> event_desc)
            $table->string('event_type')->nullable(); // Event type
            $table->timestamps();  // Created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Antivirus');
    }
};
