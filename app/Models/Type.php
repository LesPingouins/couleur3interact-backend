<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'name_of',
        'slug',
        'priority',
        'misc',
        'is_active',
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function scopeGetIDOfAType($query, $value)
    {
        return $query->select('id')->where('slug', $value);
    }
}
