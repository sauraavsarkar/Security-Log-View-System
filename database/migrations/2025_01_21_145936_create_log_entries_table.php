<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('log_entries', function (Blueprint $table) {
            $table->id();
            $table->string('log_type');      // Folder name (Antivirus, Firewall, etc.)
            $table->timestamp('time');       // Log timestamp
            $table->string('ip_src');        // Source IP
            $table->string('username');      // Username
            $table->text('msg');             // Message
            $table->string('device_type');   // Device type
            $table->string('host_dst');      // Destination host
            $table->text('event_desc');      // Event description
            $table->string('event_type');    // Event type
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_entries');
    }
};
