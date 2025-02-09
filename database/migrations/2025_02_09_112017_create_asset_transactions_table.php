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
        Schema::create('asset_transactions', function (Blueprint $table) {
            $table->id();
            $table->date('out_date')->nullable();
            $table->date('return_date')->nullable();
            $table->date('due_date')->nullable();
            $table->string('out_photo')->nullable();
            $table->string('return_photo')->nullable();
            $table->enum('status', ['OUT','RETURN','DUE RETURN']);
            $table->unsignedBigInteger('application_id');
            $table->timestamps();

            $table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_transactions');
    }
};
