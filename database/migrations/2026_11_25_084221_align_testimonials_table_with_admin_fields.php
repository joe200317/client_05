<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('testimonials')) {
            return;
        }

        Schema::table('testimonials', function (Blueprint $table) {
            if (Schema::hasColumn('testimonials', 'name') && ! Schema::hasColumn('testimonials', 'learner_name')) {
                $table->renameColumn('name', 'learner_name');
            }

            if (Schema::hasColumn('testimonials', 'context') && ! Schema::hasColumn('testimonials', 'program_or_role')) {
                $table->renameColumn('context', 'program_or_role');
            }

            if (Schema::hasColumn('testimonials', 'sort_order') && ! Schema::hasColumn('testimonials', 'display_order')) {
                $table->renameColumn('sort_order', 'display_order');
            }

            if (! Schema::hasColumn('testimonials', 'show_on_home')) {
                $table->boolean('show_on_home')->default(false)->after('is_published');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('testimonials')) {
            return;
        }

        Schema::table('testimonials', function (Blueprint $table) {
            if (Schema::hasColumn('testimonials', 'learner_name') && ! Schema::hasColumn('testimonials', 'name')) {
                $table->renameColumn('learner_name', 'name');
            }

            if (Schema::hasColumn('testimonials', 'program_or_role') && ! Schema::hasColumn('testimonials', 'context')) {
                $table->renameColumn('program_or_role', 'context');
            }

            if (Schema::hasColumn('testimonials', 'display_order') && ! Schema::hasColumn('testimonials', 'sort_order')) {
                $table->renameColumn('display_order', 'sort_order');
            }

            if (Schema::hasColumn('testimonials', 'show_on_home')) {
                $table->dropColumn('show_on_home');
            }
        });
    }
};
