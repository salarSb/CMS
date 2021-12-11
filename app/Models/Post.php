<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Traits\DataTable;

class Post extends Model
{
    use HasFactory, DataTable;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'body',
        'image',
        'view',
        'approved',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'catable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'tagable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function path()
    {
        return '/posts/' . $this->slug;
    }

    public function isApproved()
    {
        return $this->approved;
    }

    public function scopeSearch($query, $keywords)
    {
        $keywords = explode(' ', $keywords);
        foreach ($keywords as $keyword) {
            $query->where('title', 'LIKE', '%' . $keyword . '%')
                ->orWhereHas('categories', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', '%' . $keyword . '%');
                })->orWhereHas('tags', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', '%' . $keyword . '%');
                });
        }
        return $query;
    }
}
