<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /** Run the migrations. */
    public function up(): void
    {
        Schema::create('race_locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->json('images');
            $table->json('options');
            $table->foreignId('category_id')->constrained('categories');
            $table->timestamps();
        });
    }

    /** Reverse the migrations. */
    public function down(): void
    {
        Schema::dropIfExists('race_locations');
    }
};
