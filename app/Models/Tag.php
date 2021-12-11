<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Traits\DataTable;

class Tag extends Model
{
    use HasFactory, DataTable;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'tagable');
    }
}
