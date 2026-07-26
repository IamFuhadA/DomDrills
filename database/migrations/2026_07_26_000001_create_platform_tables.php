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
        // Membership Plans
        Schema::create('membership_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->decimal('price', 10, 2);
            $table->string('billing_period'); // monthly, quarterly, yearly
            $table->text('description')->nullable();
            $table->json('features')->nullable();
            $table->timestamps();
        });

        // Memberships
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('membership_plan_id')->constrained('membership_plans')->onDelete('cascade');
            $table->string('status')->default('active'); // active, expired, cancelled
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });

        // Courses
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->boolean('published')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Modules
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Lessons
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained('modules')->onDelete('cascade');
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->integer('order')->default(0);
            $table->integer('duration_minutes')->default(0);
            $table->timestamps();
        });

        // Videos
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained('lessons')->onDelete('cascade');
            $table->string('provider')->default('local'); // local, bunny, vimeo, etc.
            $table->string('video_id')->nullable();
            $table->string('video_path')->nullable();
            $table->integer('duration')->default(0); // in seconds
            $table->bigInteger('size')->nullable();
            $table->timestamps();
        });

        // Live Sessions
        Schema::create('live_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamp('scheduled_at');
            $table->integer('duration_minutes')->default(60);
            $table->string('meeting_link')->nullable();
            $table->string('recording_path')->nullable();
            $table->string('status')->default('scheduled'); // scheduled, live, completed, cancelled
            $table->timestamps();
        });

        // Trading Tools
        Schema::create('trading_tools', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Support Tickets
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('subject');
            $table->string('status')->default('open'); // open, pending_reply, closed
            $table->string('priority')->default('medium'); // low, medium, high
            $table->timestamps();
        });

        // Support Messages
        Schema::create('support_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('support_ticket_id')->constrained('support_tickets')->onDelete('cascade');
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->text('message');
            $table->timestamps();
        });

        // Payments
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('currency')->default('INR');
            $table->string('status')->default('pending'); // pending, completed, failed
            $table->string('gateway')->default('manual'); // razorpay, manual, stripe
            $table->string('transaction_id')->nullable();
            $table->timestamps();
        });

        // Activity Logs
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('activity');
            $table->json('context')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });

        // Lesson Progress
        Schema::create('lesson_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('lesson_id')->constrained('lessons')->onDelete('cascade');
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'lesson_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_progress');
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('support_messages');
        Schema::dropIfExists('support_tickets');
        Schema::dropIfExists('trading_tools');
        Schema::dropIfExists('live_sessions');
        Schema::dropIfExists('videos');
        Schema::dropIfExists('lessons');
        Schema::dropIfExists('modules');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('memberships');
        Schema::dropIfExists('membership_plans');
    }
};
