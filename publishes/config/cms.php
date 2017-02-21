<?php

return [
    'dashboard-view-path'    =>    'Cms::admin.dashboard',
    'default-thumbnail' => '<yourdomain>/uploads/no-product-image.png',

    'providers' => [
        /**
         * Cms modules
         */
        \Phambinh\Cms\Providers\ModuleServiceProvider::class,
        \Phambinh\Cms\Api\Providers\ModuleServiceProvider::class,
        \Phambinh\Cms\Authenticate\Providers\ModuleServiceProvider::class,
        \Phambinh\Cms\Contact\Providers\ModuleServiceProvider::class,
        \Phambinh\Cms\Providers\ModuleServiceProvider::class,
        \Phambinh\Cms\Providers\ModuleServiceProvider::class,
        \Phambinh\Cms\Providers\ModuleServiceProvider::class,
        \Phambinh\Cms\Providers\ModuleServiceProvider::class,
        \Phambinh\Cms\Tool\Providers\ModuleServiceProvider::class,
        \Phambinh\Cms\Providers\ModuleServiceProvider::class,

        /**
         * Others modules
         */
    ]
];
