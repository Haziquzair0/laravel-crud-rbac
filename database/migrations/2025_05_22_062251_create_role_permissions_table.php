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
        Schema::create('role_permissions', function (Blueprint $table) {
        $table->id('permission_id');
        $table->unsignedBigInteger('role_id');
        $table->string('description'); // e.g. Create, Retrieve, Update, Delete
        $table->timestamps();
        $table->foreign('role_id')->references('role_id')->on('user_roles')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permissions');
    }
};
