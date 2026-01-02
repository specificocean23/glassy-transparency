<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Filament 4.x Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration file is for configuring Filament, a beautiful
    | admin panel built on Laravel Livewire. To learn more, visit our docs.
    |
    */

    'default_filesystem_disk' => env('FILAMENT_FILESYSTEM_DISK', 'public'),

    'assets_path' => env('FILAMENT_ASSETS_PATH', 'app/filament'),

    'cache_key' => 'filament.clusters',

    'livewire' => [
        'namespace' => 'App\\Filament',
        'path' => app_path('Filament'),
        'enabled' => true,
    ],

];
