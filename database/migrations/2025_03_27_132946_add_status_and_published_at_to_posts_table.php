```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Add status column if not exists
            if (!Schema::hasColumn('posts', 'status')) {
                $table->enum('status', ['draft', 'published'])->default('draft');
            }

            // Add published_at column if not exists
            if (!Schema::hasColumn('posts', 'published_at')) {
                $table->timestamp('published_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Drop columns if needed
            $table->dropColumn(['status', 'published_at']);
        });
    }
};
