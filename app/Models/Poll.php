<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Poll extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'user_id', 'session_id', 'uuid'];
    protected static function booted()
    {
        static::creating(function ($poll) {
            $poll->uuid = (string) Str::uuid();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
