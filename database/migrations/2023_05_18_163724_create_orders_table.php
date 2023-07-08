<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /** Run the migrations. */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('reference');
            $table->decimal('amount', 10, 2);
            $table->string('payment_method', 50);
            $table->boolean('payment_status')->default(false);
            $table->boolean('shipping_status')->default(false);
            $table->string('type', 50);
            $table->timestamp('date');

            $table->boolean('status')->default(true);
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('race_id')->nullable()->constrained('races');
            $table->foreignId('product_id')->nullable()->constrained('products');
            $table->timestamps();
        });
    }

    /** Reverse the migrations. */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
