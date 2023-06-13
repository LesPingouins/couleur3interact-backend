<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'no',
        'name_of',
        'is_answer',
        'misc',
        'is_active',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function scopeGetAnswersFromAPoll($query, $value)
    {
        return $query->where('id', $value);
    }
}
