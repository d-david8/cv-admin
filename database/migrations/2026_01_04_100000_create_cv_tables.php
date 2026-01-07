<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Profile related tables for CV management
        Schema::create('profiles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name');
            $table->string('title')->nullable();
            $table->text('summary')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();
            $table->timestamps();
        });

        // Educations
        Schema::create('educations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('profile_id');
            $table->string('school');
            $table->string('degree');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
        });

        // Experiences
        Schema::create('experiences', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('profile_id');
            $table->string('company');
            $table->string('role');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
        });

        // Projects
        Schema::create('projects', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('profile_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();

            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
        });

        // Techstacks
        Schema::create('techstacks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('profile_id');
            $table->string('name');
            $table->string('level')->nullable();
            $table->timestamps();

            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
        });

        // Pivot table: project_techstack
        Schema::create('project_techstack', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('techstack_id');
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('techstack_id')->references('id')->on('techstacks')->onDelete('cascade');
        });

        // Pivot table: experience_techstack
        Schema::create('experience_techstack', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('experience_id');
            $table->unsignedBigInteger('techstack_id');
            $table->timestamps();

            $table->foreign('experience_id')->references('id')->on('experiences')->onDelete('cascade');
            $table->foreign('techstack_id')->references('id')->on('techstacks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experience_techstack');
        Schema::dropIfExists('project_techstack');
        Schema::dropIfExists('techstacks');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('experiences');
        Schema::dropIfExists('educations');
        Schema::dropIfExists('profiles');
    }
};
