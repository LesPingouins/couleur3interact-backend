<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'name_of',
        'slug',
        'is_active',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
