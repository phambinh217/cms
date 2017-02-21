<?php

namespace Packages\Cms\Http\Controllers\Admin;

use AppController;

class DashboardController extends AdminController
{
    public function index()
    {
        \Metatag::set('title', 'Bảng quản trị');
        return view(config('cms.dashboard-view-path'), $this->data);
    }
}
