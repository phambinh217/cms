<?php 

namespace Phambinh\Cms\Http\Controllers\Admin;

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
        return view('Cms::admin.theme.index', $this->data);
    }
}
