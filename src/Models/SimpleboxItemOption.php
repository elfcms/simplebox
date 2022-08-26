<?php

namespace Elfcms\Simplebox\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimpleboxItemOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'data_type_id',
        'name',
        'value',
        'value_int',
        'value_float',
        'value_date',
        'value_datetime',
    ];

    //protected $table = 'simplebox_item_options';

    public function items()
    {
        return $this->belongsTo(SimpleboxItem::class, 'item_id');
    }
}
