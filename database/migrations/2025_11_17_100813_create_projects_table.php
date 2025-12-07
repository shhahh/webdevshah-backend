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
    Schema::create('projects', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description')->nullable();
        $table->string('image')->nullable();
        $table->string('technologies')->nullable(); // comma-separated
        $table->string('github_link')->nullable();
        $table->string('live_link')->nullable();
        $table->timestamps();
    });
}

};
