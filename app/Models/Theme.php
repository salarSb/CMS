<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Traits\DataTable;

class Theme extends Model
{
    use HasFactory, DataTable;

    protected $fillable = [
        'name',
        'slug',
        'file',
        'size',
        'images',
        'active',
    ];

    public function isActive()
    {
        return $this->active;
    }
}
