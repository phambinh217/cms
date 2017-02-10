<?php

return [
    'dashboard-view-path'    =>    'Admin::admin.dashboard',
    'default-thumbnail' => '<yourdomain>/uploads/no-product-image.png',
    'default-avatar' => '<yourdomain>/uploads/avatars/no-avatar.jpg',
    'default-icon' => '<yourdomain>/public/uploads/icons/no-icon.png',

    'providers' => [
        /**
         * Cms modules
         */
        \Phambinh\Cms\Admin\Providers\ModuleServiceProvider::class,
        \Phambinh\Cms\Api\Providers\ModuleServiceProvider::class,
        \Phambinh\Cms\Authenticate\Providers\ModuleServiceProvider::class,
        \Phambinh\Cms\Contact\Providers\ModuleServiceProvider::class,
        \Phambinh\Cms\File\Providers\ModuleServiceProvider::class,
        \Phambinh\Cms\ModuleControl\Providers\ModuleServiceProvider::class,
        \Phambinh\Cms\Profile\Providers\ModuleServiceProvider::class,
        \Phambinh\Cms\Setting\Providers\ModuleServiceProvider::class,
        \Phambinh\Cms\Tool\Providers\ModuleServiceProvider::class,
        \Phambinh\Cms\User\Providers\ModuleServiceProvider::class,

        /**
         * Others modules
         */
    ]
];
