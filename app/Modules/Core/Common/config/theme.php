<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default active Theme
    |--------------------------------------------------------------------------
    |
    | Default default theme. like as
    |  'default' => [
    |    'site' => 'default',
    |    'admin' => 'admin',
    |  ],
    |
    */
    'default' => [
        'site' => 'default',
        'admin' => 'admin',
    ],

    /*
    |--------------------------------------------------------------------------
    | Database Config
    |--------------------------------------------------------------------------
    |
    | Here you can specify themes database settings
    |
    */
    'database' => [
        'table' => 'themes',
    ],

    /*
    |--------------------------------------------------------------------------
    | Themes path
    |--------------------------------------------------------------------------
    |
    | This path used for save the generated theme. This path also will added
    | automatically to list of scanned folders.
    |
    */
    'path' => public_path('themes'),

    /*
    |--------------------------------------------------------------------------
    | Symbolic link
    |--------------------------------------------------------------------------
    |
    | If you theme_path is not in public folder then symlink must be true
    | otherwise theme assets not working. If your theme_path under public folder
    | then symlink can be false or true as your wish.
    |
    */
    'symlink'    => true,

    /*
    |--------------------------------------------------------------------------
    | Theme types where you can set default theme for particular middleware.
    |--------------------------------------------------------------------------
    | 'types'     => [
    |       'enable' => true or false,
    |       'middleware' => [
    |           'middlewareName'      => 'themeName',
    |       ]
    |   ],
    |
    | For Example route
    | Route::get('/', function () {
    |       return view('welcome');
    | })->middleware('example');
    |
    |
    */
    'types'     => [
        'enable'        => false,
        'middleware'    => [
            'example'      => 'admin',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Theme config name and change log file name
    |--------------------------------------------------------------------------
    |
    | Here is the config for theme.json file and changelog
    | for version control status
    |
    */
    'config'     => [
        'name'      => 'theme.json',
        'changelog' => 'changelog.json',
    ],

    /*
    |--------------------------------------------------------------------------
    | Themes folder structure
    |--------------------------------------------------------------------------
    |
    | Here you may update theme folder structure.
    |
    */
    'folders'    => [
        'assets'  => 'assets',
        'views'   => 'views',
        'lang'    => 'lang',
        'lang/en' => 'lang/en',

        'css' => 'assets/css',
        'js'  => 'assets/js',
        'img' => 'assets/img',

        'layouts' => 'views/layouts',
    ]

];
