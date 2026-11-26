<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (! Schema::hasColumn('users', 'role')) {
                    $table->string('role')->default('admin')->after('password');
                }
            });
        }

        if (! Schema::hasTable('programs')) {
            Schema::create('programs', function (Blueprint $table) {
                $table->id();
                $table->string('category', 120);
                $table->string('type', 120);
                $table->string('title', 180);
                $table->string('slug', 200)->unique();
                $table->text('description');
                $table->string('schedule_or_format', 160)->nullable();
                $table->decimal('price', 10, 2)->nullable();
                $table->string('button_label', 80)->default('Know more');
                $table->string('button_link', 255)->nullable();
                $table->integer('display_order')->default(0);
                $table->boolean('is_visible')->default(true);
                $table->timestamps();

                $table->index(['is_visible', 'display_order']);
            });
        }

        if (! Schema::hasTable('gallery_photos')) {
            Schema::create('gallery_photos', function (Blueprint $table) {
                $table->id();
                $table->string('title', 180);
                $table->text('description')->nullable();
                $table->string('image_path', 255);
                $table->integer('display_order')->default(0);
                $table->boolean('is_visible')->default(true);
                $table->timestamps();

                $table->index(['is_visible', 'display_order']);
            });
        }

        // Skip if an earlier testimonials migration already created the table.
        if (! Schema::hasTable('testimonials')) {
            Schema::create('testimonials', function (Blueprint $table) {
                $table->id();
                $table->text('quote');
                $table->string('learner_name', 140);
                $table->string('program_or_role', 160)->nullable();
                $table->boolean('show_on_home')->default(true);
                $table->integer('display_order')->default(0);
                $table->timestamps();

                $table->index(['show_on_home', 'display_order']);
            });
        }

        if (! Schema::hasTable('blog_posts')) {
            Schema::create('blog_posts', function (Blueprint $table) {
                $table->id();
                $table->string('category', 120);
                $table->string('title', 200);
                $table->string('slug', 220)->unique();
                $table->text('excerpt');
                $table->longText('content');
                $table->string('reading_time', 60)->nullable();
                $table->string('cover_image_path', 255)->nullable();
                $table->date('published_at');
                $table->boolean('is_published')->default(true);
                $table->timestamps();

                $table->index(['is_published', 'published_at']);
            });
        }

        if (! Schema::hasTable('session_bookings')) {
            Schema::create('session_bookings', function (Blueprint $table) {
                $table->id();
                $table->string('name', 140);
                $table->string('email', 160);
                $table->string('program', 160);
                $table->string('timing', 160);
                $table->text('message');
                $table->string('status', 30)->default('new');
                $table->timestamps();

                $table->index(['status', 'created_at']);
            });
        }

        if (! Schema::hasTable('contact_messages')) {
            Schema::create('contact_messages', function (Blueprint $table) {
                $table->id();
                $table->string('name', 140);
                $table->string('email', 160);
                $table->string('phone', 40)->nullable();
                $table->string('topic', 160);
                $table->text('message');
                $table->boolean('is_read')->default(false);
                $table->timestamps();

                $table->index(['is_read', 'created_at']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
        Schema::dropIfExists('session_bookings');
        Schema::dropIfExists('blog_posts');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('gallery_photos');
        Schema::dropIfExists('programs');

        if (Schema::hasTable('users') && Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('role');
            });
        }
    }
};
