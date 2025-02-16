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
        Schema::create('Firewall', function (Blueprint $table) {
            $table->id();
            $table->timestamp('time');
            $table->string('ip_src');
            $table->string('ip_dst');
            $table->string('action');
            $table->string('country_src');
            $table->string('country_dst');
            $table->string('city_src');
            $table->string('city_dst');
            $table->string('url');
            $table->string('direction');
            $table->string('org_src');
            $table->string('org_dst');
            $table->string('user_agent');
            $table->text('event_desc');
            $table->integer('bytes_src');
            $table->string('domain_src');
            $table->string('device_class');
            $table->integer('ip_dstport');
            $table->string('severity');
            $table->string('severity_action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Firewall');
    }
};

