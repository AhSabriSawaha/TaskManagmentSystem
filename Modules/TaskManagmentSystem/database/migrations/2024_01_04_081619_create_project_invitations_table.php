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
        Schema::create('project_invitations', function (Blueprint $table) {

            $table->id();
            // user id and project id
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('project_id')->constrained('projects');
            $table->boolean('accepted')->default(false); // Status of the invitation
            $table->string('token', 32)->unique(); // Unique token for the invitation
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_invitations');
    }
};
