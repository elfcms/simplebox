@extends('simplebox::admin.layouts.simplebox')

@section('simpleboxpage-content')

    @if (Session::has('itemedited'))
        <div class="alert alert-success">{{ Session::get('itemedited') }}</div>
    @endif
    @if (Session::has('itemcreated'))
        <div class="alert alert-success">{{ Session::get('itemcreated') }}</div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="errors-list">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="item-form">
        <h3>{{ __('simplebox::elf.edit_item') }} {{$item->id}}</h3>
        <form action="{{ route('admin.simplebox.items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="colored-rows-box">
                <div class="input-box colored">
                    <label for="code">{{ __('basic::elf.code') }}</label>
                    <div class="input-wrapper">
                        <input type="text" name="code" id="code" autocomplete="off" data-isslug value="{{ $item->code }}">
                    </div>
                    <div class="input-wrapper">
                        <div class="autoslug-wrapper">
                            <input type="checkbox" data-text-id="title" data-slug-id="code" class="autoslug" checked>
                            <div class="autoslug-button"></div>
                        </div>
                    </div>
                </div>
                <div class="input-box colored">
                    <label for="title">{{ __('basic::elf.title') }}</label>
                    <div class="input-wrapper">
                        <input type="text" name="title" id="title" autocomplete="off" value="{{ $item->title }}">
                    </div>
                </div>
                <div class="input-box colored">
                    <label for="text">{{ __('basic::elf.text') }}</label>
                    <div class="input-wrapper">
                        <textarea name="text" id="text" cols="30" rows="10">{{ $item->text }}</textarea>
                    </div>
                </div>
                <div class="input-box colored">
                    <label for="image">{{ __('basic::elf.image') }}</label>
                    <div class="input-wrapper">
                        <input type="hidden" name="image_path" id="image_path" value="{{$item->image}}">
                        <div class="image-button">
                            <div class="delete-image @if (empty($item->image)) hidden @endif">&#215;</div>
                            <div class="image-button-img">
                            @if (!empty($item->image))
                                <img src="{{ asset($item->image) }}" alt="Image">
                            @else
                                <img src="{{ asset('/vendor/elfcms/blog/admin/images/icons/upload.png') }}" alt="Upload file">
                            @endif
                            </div>
                            <div class="image-button-text">
                            @if (!empty($post->image))
                                {{ __('basic::elf.change_file') }}
                            @else
                                {{ __('basic::elf.choose_file') }}
                            @endif
                            </div>
                            <input type="file" name="image" id="image">
                        </div>
                    </div>
                </div>
                <div class="input-box colored" id="optionsbox">
                    <label for="">{{ __('simplebox::elf.options') }}</label>
                    <div class="input-wrapper">
                        <div>
                            <div class="sb-input-options-table">
                                <div class="options-table-head-line">
                                    <div class="options-table-head">
                                        {{ __('simplebox::elf.type') }}
                                    </div>
                                    <div class="options-table-head">
                                        {{ __('basic::elf.name') }}
                                    </div>
                                    <div class="options-table-head">
                                        {{ __('basic::elf.value') }}
                                    </div>
                                    <div class="options-table-head"></div>
                                </div>
                                @foreach ($item->options as $option)
                                <div class="options-table-string-line" data-line="{{$option->id}}">
                                    <div class="options-table-string">
                                        <select name="options_new[{{$option->id}}][type]" id="option_new_type_{{$option->id}}" data-option-type>
                                        @foreach ($data_types as $type)
                                            <option value="{{ $type->id }}" @if($type->id == $option->data_type_id) selected @endif>{{ $type->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="options-table-string">
                                        <input type="text" name="options_new[{{$option->id}}][name]" id="option_new_name_{{$option->id}}" data-option-name data-isslug>
                                    </div>
                                    <div class="options-table-string">
                                        <input type="text" name="options_new[{{$option->id}}][value]" id="option_new_value_{{$option->id}}" data-option-value>
                                    </div>
                                    <div class="options-table-string"></div>
                                </div>
                                @endforeach
                                <div class="options-table-string-line" data-line="{{$next_option_id}}">
                                    <div class="options-table-string">
                                        <select name="options_new[{{$next_option_id}}][type]" id="option_new_type_{{$next_option_id}}" data-option-type>
                                        @foreach ($data_types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="options-table-string">
                                        <input type="text" name="options_new[{{$next_option_id}}][name]" id="option_new_name_{{$next_option_id}}" data-option-name data-isslug>
                                    </div>
                                    <div class="options-table-string">
                                        <input type="text" name="options_new[{{$next_option_id}}][value]" id="option_new_value_{{$next_option_id}}" data-option-value>
                                    </div>
                                    <div class="options-table-string"></div>
                                </div>
                            </div>
                            <button type="button" class="default-btn option-table-add" id="addoptionline">{{ __('basic::elf.add_option') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="button-box single-box">
                <button type="submit" class="default-btn submit-button">{{ __('basic::elf.submit') }}</button>
            </div>
        </form>
    </div>
    <script>
    autoSlug('.autoslug')
    inputSlugInit()
    const imageInput = document.querySelector('#image')
    if (imageInput) {
        inputFileImg(imageInput)
    }


simpleboxOptionInit({{$next_option_id}});
    </script>

@endsection
