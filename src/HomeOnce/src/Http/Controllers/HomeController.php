<?php 

namespace Phambinh\Cms\HomeOnce\Http\Controllers;

use HomeController as CoreHomeController;

class HomeController extends CoreHomeController
{
    public function index()
    {
        return view('HomeOnce::home', $this->data);
    }
}
