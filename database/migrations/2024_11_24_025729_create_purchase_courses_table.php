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
        Schema::create('purchase_courses', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('course_id');
            $table->string('student_id');
            $table->integer('price');
            $table->string('payment_id');
            $table->string('date_time');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_courses');
    }
};
