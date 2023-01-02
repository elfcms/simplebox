<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Version
    |--------------------------------------------------------------------------
    |
    | Version of package
    |
    */

    'version' => '0.5',

    /*
    |--------------------------------------------------------------------------
    | Version of ELF CMS Basic
    |--------------------------------------------------------------------------
    |
    | Minimum version of ELF CMS Basic package
    |
    */

    'basic_package' => '1.2.0',

    /*
    |--------------------------------------------------------------------------
    | Menu data
    |--------------------------------------------------------------------------
    |
    | Menu data of this package for admin panel
    |
    */

    "menu" => [
        [
            "title" => "SimpleBox",
            "lang_title" => "simplebox::elf.simplebox",
            "route" => "admin.simplebox.items",
            "parent_route" => "admin.simplebox.items",
            "icon" => "/vendor/elfcms/simplebox/admin/images/icons/box.png",
            "position" => 90,
            "submenu" => []
        ],
    ],

    'components' => [
        'box' => [
            'class' => '\Elfcms\Simplebox\View\Components\Box',
            'options' => [
                'item' => false,
                'theme' => 'default',
            ],
        ],
    ],
];
