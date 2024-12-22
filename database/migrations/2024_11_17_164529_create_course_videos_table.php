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
        Schema::create('course_videos', function (Blueprint $table) {
            $table->id();
            $table->string('video_id');
            $table->string('course_id');
            $table->string('video_name');
            $table->text('video_url');
            $table->string('video_image');
            $table->text('video_description');
            $table->string('video_pdf');
            $table->integer('is_active')->default(1)->comment('0-Inactive, 1-Active');
            $table->integer('is_deleted')->default(0)->comment('0-non deleted, 1-deleted');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_videos');
    }
};
