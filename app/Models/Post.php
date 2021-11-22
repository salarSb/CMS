<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'body',
        'images',
        'view',
        'approved',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function path()
    {
        return '/posts/' . $this->slug;
    }

    public function isApproved()
    {
        return $this->approved;
    }
}
