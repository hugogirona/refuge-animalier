<?php

use App\Enums\PetBreeds;
use App\Enums\PetSex;
use App\Enums\PetStatus;
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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('species');
            $table->string('breed')->default(PetBreeds::UNKNOWN->value);
            $table->string('sex')->default(PetSex::UNKNOWN->value);
            $table->string('coat_color');
            $table->date('birth_date')->nullable();
            $table->date('last_vet_visit')->nullable();
            $table->text('vaccinations')->nullable();
            $table->boolean('sterilized');
            $table->text('personality');
            $table->text('story');
            $table->string('status')->default(PetStatus::AVAILABLE->value);
            $table->string('photo_path')->nullable();
            $table->boolean('is_published')->default(false);

            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('published_by')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamp('published_at')->nullable();
            $table->date('arrived_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
