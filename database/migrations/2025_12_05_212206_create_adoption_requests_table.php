<?php

use App\Enums\AdoptionRequestStatus;
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
        Schema::create('adoption_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_id')->constrained('pets')->onDelete('cascade');

            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');

            $table->string('address');
            $table->string('city');
            $table->string('zip_code');

            $table->string('accommodation_type');
            $table->boolean('has_garden');
            $table->text('has_other_pets')->nullable();
            $table->text('had_same')->nullable();

            $table->json('available_days')->nullable();
            $table->json('available_hours')->nullable();
            $table->string('preferred_contact_method')->nullable();

            $table->text('message')->nullable();

            $table->boolean('newsletter_consent')->default(false);

            $table->string('status');
            $table->timestamp('notified_at')->nullable();
            $table->foreignId('processed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('adopted_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adoption_requests');
    }
};
