<?php

namespace Phambinh\Cms\Http\Controllers\Admin;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use AdminController;

class ModuleController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['modules'] = \Module::where('type', 'module');
        return view('Cms::admin.module.index', $this->data);
    }
}
