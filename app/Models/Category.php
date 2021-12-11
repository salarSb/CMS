<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Traits\DataTable;

class Category extends Model
{
    use HasFactory, DataTable;

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
    ];

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'catable');
    }

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
