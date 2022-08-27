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

    'version' => '0.3',

    /*
    |--------------------------------------------------------------------------
    | Version of ELF CMS Basic
    |--------------------------------------------------------------------------
    |
    | Minimum version of ELF CMS Basic package
    |
    */

    'basic_package' => '0.7',

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
            "submenu" => []
        ],
    ],
];
