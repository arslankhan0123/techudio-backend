<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quote_requests', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('company')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->json('services')->nullable();
            $table->text('other_services')->nullable();
            $table->string('project_type')->nullable();
            $table->text('description')->nullable();
            $table->json('assets')->nullable();
            $table->string('budget')->nullable();
            $table->string('timeline')->nullable();
            $table->json('communication')->nullable();
            $table->string('nda')->nullable();
            $table->text('details')->nullable();
            $table->json('attachments')->nullable();
            $table->boolean('agree_contact')->default(false);
            $table->boolean('agree_privacy')->default(false);
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_requests');
    }
};
