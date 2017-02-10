<?php 

namespace Phambinh\Cms\Admin\Http\Controllers;

use Illuminate\Http\Request;
use AppController;
use Mail;
use Validator;

class ContactController extends AppController
{
    public function create()
    {
        \Metatag::set('title', 'Liên hệ');
        return view('Admin::contact.create', $this->data);
    }
}
