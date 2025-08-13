<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_image',
        'heading',
        'date',
        'time',
        'end_date',
        'end_time',
        'occurrence_type',
        'event_access_type',
        'expected_guest',
        'address',
        'entry',
        'desc',
        'youtube_url',
        'special_details',
        'artist_performer', // New field
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_event');
    }
}
