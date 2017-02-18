<?php 

namespace Phambinh\Cms\ModuleControl\Http\Controllers\Admin;

use Illuminate\Http\Request;
use AdminController;

class ThemeController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['themes'] = \Module::where('type', 'theme');
        $this->authorize('admin.module-control.index');
        return view('ModuleControl::admin.theme.index', $this->data);
    }
}
