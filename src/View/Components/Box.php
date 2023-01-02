<?php

namespace Elfcms\Simplebox\View\Components;

use Elfcms\Simplebox\Models\SimpleboxItem;
use Illuminate\View\Component;

class Box extends Component
{
    public $item, $theme;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($item, $theme='default')
    {
        if (is_numeric($item)) {
            $item = intval($item);
            $item = SimpleboxItem::with('options')->find($item);
        }
        elseif (gettype($item) == 'string') {
            $item = SimpleboxItem::where('code',$item)->with('options')->first();
        }
        $this->item = $item;
        $this->theme = $theme;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('simplebox::components.box.'.$this->theme);
    }
}
