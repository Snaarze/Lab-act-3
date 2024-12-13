<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['headline', 'content', 'date_published', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
