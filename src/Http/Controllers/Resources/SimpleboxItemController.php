<?php

namespace Elfcms\Simplebox\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use Elfcms\Simplebox\Models\SimpleboxDataType;
use Elfcms\Simplebox\Models\SimpleboxItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SimpleboxItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $trend = 'asc';
        $order = 'id';
        if (!empty($request->trend) && $request->trend == 'desc') {
            $trend = 'desc';
        }
        if (!empty($request->order)) {
            $order = $request->order;
        }
        $search = $request->search ?? '';
        if (!empty($search)) {
            $items = SimpleboxItem::where('title','like',"%{$search}%")->orderBy($order, $trend)->paginate(30);

        }
        else {
            $items = SimpleboxItem::orderBy($order, $trend)->paginate(30);

        }

        return view('simplebox::admin.simplebox.items.index',[
            'page' => [
                'title' => __('simplebox::elf.simplebox') . ' ' . __('simplebox::elf.items'),
                'current' => url()->current(),
            ],
            'items' => $items,
            'params' => $request->all(),
            'search' => $search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_types = SimpleboxDataType::all();
        return view('simplebox::admin.simplebox.items.create',[
            'page' => [
                'title' => __('simplebox::elf.simplebox') . ' ' . __('simplebox::elf.items'),
                'current' => url()->current(),
            ],
            'data_types' => $data_types
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge([
            'code' => Str::slug($request->code),
        ]);
        $validated = $request->validate([
            'title' => 'required',
            'code' => 'required|unique:Elfcms\Simplebox\Models\SimpleboxItem,code',
            'image' => 'nullable|file|max:512',
        ]);

        $image_path = '';
        if (!empty($request->file()['image'])) {
            $image = $request->file()['image']->store('public/simplebox/items/image');
            $image_path = str_ireplace('public/','/storage/',$image);
        }

        $validated['image'] = $image_path;
        $validated['text'] = $request->text;

        $item = SimpleboxItem::create($validated);

        if ($item && !empty($request->options_new)) {
            foreach ($request->options_new as $i => $param) {
                if (empty($param['type']) || empty($param['name'])) {
                    continue;
                }
                $optionData = [
                    'name' => $param['name'],
                    'data_type_id' => $param['type'],
                    'value' => $param['value'],
                ];
                $item->options()->create($optionData);
            }
        }

        return redirect(route('admin.simplebox.items.edit',$item->id))->with('itemcreated',__('simplebox::elf.item_created_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SimpleboxItem  $simpleboxItem
     * @return \Illuminate\Http\Response
     */
    public function show(SimpleboxItem $simpleboxItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SimpleboxItem  $simpleboxItem
     * @return \Illuminate\Http\Response
     */
    public function edit(SimpleboxItem $simpleboxItem)
    {
        dd($simpleboxItem);
        $data_types = SimpleboxDataType::all();
        $next_option_id = $simpleboxItem->options->max();
        if (empty($next_option_id)) {
            $next_option_id = 0;
        }
        else {
            $next_option_id++;
        }
        return view('simplebox::admin.simplebox.items.edit',[
            'page' => [
                'title' => __('simplebox::elf.simplebox') . ' ' . __('simplebox::elf.item') . '#' . $simpleboxItem->id,
                'current' => url()->current(),
            ],
            'item' => $simpleboxItem,
            'next_option_id' => $next_option_id,
            'data_types' => $data_types
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SimpleboxItem  $simpleboxItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SimpleboxItem $simpleboxItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SimpleboxItem  $simpleboxItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(SimpleboxItem $simpleboxItem)
    {
        //
    }
}
