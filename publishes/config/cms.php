<?php

return [
    'dashboard-view-path'    =>    'Cms::admin.dashboard',
    'default-thumbnail' => '<yourdomain>/uploads/no-product-image.png',

    'providers' => [
        /**
         * Cms modules
         */
        \Packages\Cms\Providers\ModuleServiceProvider::class,
        \Packages\Cms\Api\Providers\ModuleServiceProvider::class,
        \Packages\Cms\Authenticate\Providers\ModuleServiceProvider::class,
        \Packages\Cms\Contact\Providers\ModuleServiceProvider::class,
        \Packages\Cms\Providers\ModuleServiceProvider::class,
        \Packages\Cms\Providers\ModuleServiceProvider::class,
        \Packages\Cms\Providers\ModuleServiceProvider::class,
        \Packages\Cms\Providers\ModuleServiceProvider::class,
        \Packages\Cms\Tool\Providers\ModuleServiceProvider::class,
        \Packages\Cms\Providers\ModuleServiceProvider::class,

        /**
         * Others modules
         */
    ]
];
