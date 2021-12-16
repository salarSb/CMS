<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Traits\DataTable;

class Comment extends Model
{
    use HasFactory, DataTable;

    protected $fillable = [
        'user_id',
        'parent_id',
        'text',
        'approved',
        'commentable_id',
        'commentable_type'

    ];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isApproved()
    {
        return $this->approved;
    }
}
