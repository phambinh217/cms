<?php

return [
    'dashboard-view-path'       => 'Cms::admin.dashboard',
    'upload_path'               => public_path('uploads'),
    'thumb_path'                => public_path('uploads/thumbs'),

    'providers' => [
        \Ixudra\Curl\CurlServiceProvider::class,
        \Folklore\Image\ImageServiceProvider::class,
        \Phambinh\Appearance\Providers\ModuleServiceProvider::class,
        \Phambinh\News\Providers\ModuleServiceProvider::class,
        \Phambinh\Page\Providers\ModuleServiceProvider::class,
        \Phambinh\Cms\Providers\RoutingServiceProvider::class,
        \Phambinh\CmsInstall\Providers\ModuleServiceProvider::class,
        \Phambinh\CmsInstall\Providers\RoutingServiceProvider::class,
    ],

    'aliases' => [
        'AccessControl'     =>  \Phambinh\Cms\Support\Facades\AccessControl::class,
        'AdminController'   =>  \Phambinh\Cms\Http\Controllers\Admin\AdminController::class,
        'AdminMenu'         =>  \Phambinh\Cms\Support\Facades\AdminMenu::class,
        'Contact'           =>  \Phambinh\Cms\Support\Facades\Contact::class,
        'Module'            =>  \Phambinh\Cms\Support\Facades\Module::class,
        'Setting'           =>  \Phambinh\Cms\Support\Facades\Setting::class,
        'Widget'            =>  \Phambinh\Cms\Support\Facades\Widget::class,
        'HomeController'    =>  \Phambinh\Cms\Http\Controllers\HomeController::class,
        'AppController'     =>  \Phambinh\Cms\Http\Controllers\AppController::class,
        'ApiController'     =>  \Phambinh\Cms\Http\Controllers\ApiController::class,
        'Curl'              =>  \Ixudra\Curl\Facades\Curl::class,
        'Menu'              =>  \Phambinh\Appearance\Support\Facades\Menu::class,
        'Action'            =>  \Phambinh\Cms\Support\Facades\Action::class,
        'Filter'            =>  \Phambinh\Cms\Support\Facades\Filter::class,
        'Metatag'           =>  \Phambinh\Cms\Support\Facades\Metatag::class,
        'Image'             =>  \Folklore\Image\Facades\Image::class,
    ],

    'consoles' => [
        \Phambinh\Cms\Console\Generators\MakeModule::class,
        \Phambinh\Cms\Console\Generators\MakeProvider::class,
        \Phambinh\Cms\Console\Generators\MakeController::class,
        \Phambinh\Cms\Console\Generators\MakeMiddleware::class,
        \Phambinh\Cms\Console\Generators\MakeRequest::class,
        \Phambinh\Cms\Console\Generators\MakeModel::class,
        \Phambinh\Cms\Console\Generators\MakeFacade::class,
        \Phambinh\Cms\Console\Generators\MakeService::class,
        \Phambinh\Cms\Console\Generators\MakeSupport::class,
        \Phambinh\Cms\Console\Generators\MakeMigration::class,
        \Phambinh\Cms\Console\Generators\MakeCommand::class,
        \Phambinh\Cms\Console\Generators\MakeWidget::class,
    ],
];
