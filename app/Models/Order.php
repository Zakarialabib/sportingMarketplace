<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\OrderStatus;
use App\Enums\OrderType;

class Order extends Model
{
    use HasFactory;

    public const ATTRIBUTES = [
        'id',
        'user_id',
        'race_id',
        'service_id',
        'product_id',
        'amount',
        'payment_method',
        'status',
        'payment_status',
        'shipping_status',
        'type',
        'date',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'user_id',
        'race_id',
        'service_id',
        'product_id',
        'amount',
        'payment_method',
        'status',
        'payment_status',
        'shipping_status',
        'type',
        'date',
    ];

    protected $casts = [
        'status' => OrderStatus::class,
        'type'   => OrderType::class,
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Race model
    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    // Define the relationship with the Service model
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}