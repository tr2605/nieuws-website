<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{



    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->text('description');
            $table->foreignId('articlesId')->constrained('articles');
            $table->foreignId('usersid')->constrained('users');
        });
    }



    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
