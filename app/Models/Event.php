<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'event_image',
        'heading',
        'venue',
        'city',
        'date',
        'time',
        'end_date',
        'end_time',
        'occurrence_type',
        'event_access_type',
        'expected_guest',
        'address',
        'entry',
        'price',
        'desc',
        'youtube_url',
        'special_details',
        'artist_performer',
        'status',
        'terms_and_conditions',
    ];

    /**
     * Get the user that owns the event.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * The categories that belong to the event.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_event');
    }
}
