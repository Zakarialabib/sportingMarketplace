<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /** Run the migrations. */
    public function up(): void
    {
        Schema::create('races', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->date('date');
            $table->longText('description')->nullable();
            $table->foreignId('race_location_id')->constrained('race_locations');
            $table->foreignId('category_id')->constrained('categories');
            $table->integer('number_of_days')->nullable();
            $table->integer('number_of_racers');
            $table->decimal('price', 8, 2);
            $table->decimal('discount_price', 8, 2)->nullable();
            $table->dateTime('start_registration');
            $table->dateTime('end_registration');
            $table->dateTime('registration_deadline')->nullable();
            $table->boolean('google_calendar')->default(false);
            $table->string('docs_link')->nullable();
            $table->string('google_calendar_id')->nullable();
            $table->string('images')->nullable();
            $table->json('social_media')->nullable();
            $table->json('sponsors')->nullable();
            $table->json('course')->nullable();
            $table->json('features')->nullable();
            $table->json('options')->nullable();
            $table->json('calendar')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->boolean('status')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /** Reverse the migrations. */
    public function down(): void
    {
        Schema::dropIfExists('races');
    }
};
