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
            $table->string('application_id');
            $table->date('date');
            $table->date('return_plan_date');
            $table->date('approval_date')->nullable();
            $table->string('reg_no');
            $table->string('purpose')->nullable();
            $table->string('needs')->nullable();
            $table->string('notes')->nullable();
            $table->string('attachment')->nullable();
            $table->enum('status', ['WAITING','APPROVE','REJECT']);
            $table->unsignedBigInteger('asset_id');
            $table->unsignedBigInteger('employee_id');
            $table->timestamps();

            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
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
