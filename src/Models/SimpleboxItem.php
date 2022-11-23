<?php

namespace Elfcms\Simplebox\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimpleboxItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'title',
        'image',
        'text',
    ];

    public function options()
    {
        return $this->hasMany(SimpleboxItemOption::class, 'item_id');
    }
}
