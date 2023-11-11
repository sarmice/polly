<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;
    protected $fillable = ['option_id', 'user_id', 'session_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
