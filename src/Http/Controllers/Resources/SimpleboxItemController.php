<?php

namespace Elfcms\Simplebox\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use Elfcms\Simplebox\Models\SimpleboxItem;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
