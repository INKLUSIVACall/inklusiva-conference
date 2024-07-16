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
        Schema::table('meetings', function (Blueprint $table) {
            $table->dateTime('start')->nullable()->default(null);
            $table->unsignedBigInteger('creator_id')->nullable()->default(null);
            $table->foreign('creator_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('should_record')->default(false);
            $table->boolean('sign_language_interpreter')->default(false);
            $table->boolean('text_interpreter') ->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('meetings', function (Blueprint $table) {
            $table->dropForeign(['creator_id']);
            $table->dropColumn('should_record');
            $table->dropColumn('sign_language_interpreter');
            $table->dropColumn('text_interpreter');
        });
    }
};
