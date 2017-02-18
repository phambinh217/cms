<?php

namespace Phambinh\Cms\Admin\Http\Controllers\Admin;

use AppController;
use Illuminate\Http\Request;

class AdminController extends AppController
{
    /**
     * [$paginate description]
     * @var integer
     */
    protected $paginate = 20;

    public function __construct()
    {
        parent::__construct();
        
        $this->middleware('auth');

        do_action('admin.init');
        do_action('admin.destroy');
    }
}
