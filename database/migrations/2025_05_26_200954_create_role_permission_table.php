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
        Schema::create('role_permission', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('permission_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('role_id')->references('role_id')->on('user_roles')->onDelete('cascade');
            $table->foreign('permission_id')->references('permission_id')->on('role_permissions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permission');
    }
};
