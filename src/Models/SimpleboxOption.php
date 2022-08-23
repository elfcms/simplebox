<?php

namespace Elfcms\Simplebox\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimpleboxOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'data_type_id',
        'value',
    ];

    public function items()
    {
        return $this->belongsToMany(SimpleboxOption::class, 'simplebox_item_options', 'item_id', 'option_id');
    }
}
