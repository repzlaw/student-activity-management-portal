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

        Schema::create('credential_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('type');
            $table->integer('size');
            $table->string('url');
            $table->string('status');
            $table->text('approver_comment')->nullable();
            $table->dateTime('review_date')->nullable();
            $table->foreignId('reviewer_id')->nullable()->constrained('users');
            $table->foreignId('credential_id')->nullable()->constrained();
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
        Schema::dropIfExists('credential_attachments');
    }
};
