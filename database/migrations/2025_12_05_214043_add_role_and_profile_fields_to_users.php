<?php

use App\Enums\UserRoles;
use App\Enums\UserStatus;
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
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->after('email');
            $table->string('status')->after('role');
            $table->string('phone')->nullable()->after('status');
            $table->string('avatar')->nullable()->after('phone');
            $table->json('availability')->nullable()->after('avatar');
            $table->boolean('email_notifications')->after('availability');
            $table->string('email_frequency')->after('email_notifications');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'phone', 'availability', 'email_notifications']);
        });
    }
};
