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

    public function getValueAttribute($value)
    {
        $typeCode = SimpleboxDataType::find($this->data_type_id);
        switch ($typeCode->code) {
            case 'int':
                $value = $this->value_int;
                break;

            case 'float':
                $value = $this->value_float;
                break;

            case 'date':
                $value = $this->value_date;
                break;

            case 'datetime':
                $value = $this->value_datetime;
                break;

            default:
                //
                break;
        }
        return $value;
    }
}
