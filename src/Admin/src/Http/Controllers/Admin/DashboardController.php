<?php

namespace Phambinh\Cms\Admin\Http\Controllers\Admin;

use AppController;

class DashboardController extends AdminController
{
    public function index()
    {
        \Metatag::set('title', 'Bảng quản trị');
        
     	$this->authorize('admin');
        return view(config('cms.dashboard-view-path'), $this->data);
    }
}
