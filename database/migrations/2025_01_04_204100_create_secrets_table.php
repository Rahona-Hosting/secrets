<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Rahona\Models\Secret;
use Rahona\Models\User;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('secrets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->text('data')->nullable();
            $table->string('url')->unique()->nullable();
            $table->boolean('isE2EE')->default(false);
            $table->timestamp('expires_at')->nullable();
            $table->integer('max_views')->default(1);
            $table->boolean('expiration_notified')->default(false);
            $table->boolean('access_notified')->default(false);
            $table->timestamps();
        });

        Schema::create('secret_accesses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Secret::class);
            $table->string('ip');
            $table->string('user_agent');
            $table->boolean('password_incorrect')->default(false);
            $table->boolean('password_correct')->default(false);
            $table->boolean('secret_viewed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secret_accesses');
        Schema::dropIfExists('secrets');
    }
};
