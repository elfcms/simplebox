<?php

namespace Elfcms\Simplebox\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimpleboxItemOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'option_id',
    ];

    protected $table = 'simplebox_item_options';
}
