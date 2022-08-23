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
        return $this->belongsToMany(SimpleboxOption::class, 'simplebox_item_options', 'item_id', 'option_id');
    }
}
