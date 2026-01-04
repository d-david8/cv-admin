<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1️⃣ profiles
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

        // 2️⃣ educations
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

        // 3️⃣ experiences
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

        // 4️⃣ projects
        Schema::create('projects', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('profile_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();

            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
        });

        // 5️⃣ tech_stacks
        Schema::create('tech_stacks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('profile_id');
            $table->string('name');
            $table->string('level')->nullable();
            $table->timestamps();

            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
        });

        // 6️⃣ project_techstack (pivot)
        Schema::create('project_techstack', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('tech_stack_id');
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('tech_stack_id')->references('id')->on('tech_stacks')->onDelete('cascade');
        });

        // 7️⃣ experience_techstack (pivot)
        Schema::create('experience_techstack', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('experience_id');
            $table->unsignedBigInteger('tech_stack_id');
            $table->timestamps();

            $table->foreign('experience_id')->references('id')->on('experiences')->onDelete('cascade');
            $table->foreign('tech_stack_id')->references('id')->on('tech_stacks')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('experience_techstack');
        Schema::dropIfExists('project_techstack');
        Schema::dropIfExists('tech_stacks');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('experiences');
        Schema::dropIfExists('educations');
        Schema::dropIfExists('profiles');
    }
};
