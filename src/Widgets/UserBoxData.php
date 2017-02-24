<?php

namespace Phambinh\Cms\Widgets;

use Phambinh\Cms\Support\Abstracts\Widget;
use Phambinh\Cms\User;

class UserBoxData extends Widget
{
    public function run($params = null)
    {
        $this->data['total'] = User::count();
        return view('Cms::widgets.box-data', $this->data);
    }
}
