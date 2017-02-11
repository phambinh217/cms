<?php

namespace Phambinh\Cms\ModuleControl\Http\Controllers\Admin;

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
        return view('ModuleControl::admin.module.index', $this->data);
    }

    public function update(Request $request, Schedule $schedule, $alias)
    {
        $module = \Module::where('alias', $alias)->first();
        $module->markAsUpdated();

        return response()->json([
            'redirect' => route('admin.module-control.module.index'),
            'message' => // exec('cd core && composer update '.$module->packagist_name),
        ]);
    }
}
