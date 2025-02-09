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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('application_no');
            $table->date('date');
            $table->date('approval_date')->nullable();
            $table->unsignedBigInteger('total_quantity');
            $table->string('photo');
            $table->enum('status', ['WAITING','APPROVE','REJECT']);
            $table->unsignedBigInteger('requestor_id');
            $table->timestamps();

            $table->foreign('requestor_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
