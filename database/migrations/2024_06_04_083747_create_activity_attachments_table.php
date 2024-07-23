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
        Schema::disableForeignKeyConstraints();

        Schema::create('activity_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('type');
            $table->integer('size');
            $table->string('url');
            $table->string('status');
            $table->text('approver_comment')->nullable();
            $table->dateTime('approve_date')->nullable();
            $table->foreignId('approver_id')->nullable()->constrained('users');
            $table->foreignId('activity_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_attachments');
    }
};
