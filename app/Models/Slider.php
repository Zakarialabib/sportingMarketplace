<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasAdvancedFilter;

    public const StatusInactive = 0;

    public const StatusActive = 1;

    public $table = 'sliders';

    public $orderable = [
        'id', 'title', 'subtitle', 'featured', 'link', 'language_id',
    ];

    public $filterable = [
        'id', 'title', 'subtitle', 'featured', 'link', 'language_id',
    ];

    public $timestamps = false;

    protected $fillable = [
        'title', 'subtitle', 'description', 'embeded_video', 'image',
        'text_color', 'slider_settings',
        'featured', 'link', 'language_id', 'bg_color', 'status',
    ];

    /**
     * Scope a query to only include active products.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     *
     * @return void
     */
    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('sliders');
    }

    public function registerMediaConversions($media = null): void
    {
        $this->addMediaConversion('large')
            ->width(1000)
            ->height(400)
            ->performOnCollections('sliders')
            ->withResponsiveImages()
            ->format('webp');
    }
}
