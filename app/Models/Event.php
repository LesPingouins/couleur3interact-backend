<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Type;

class Event extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'name_of',
        'description',
        'image',
        'question',
        'duration',
        'is_predefined',
        'is_active',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function scopeGetEventsWithType($query, $value)
    {
        return $query->whereRelation('type', 'slug', $value);
    }

    public function scopeGetAEvent($query, $value)
    {
        return $query->where('id', $value);
    }
}
