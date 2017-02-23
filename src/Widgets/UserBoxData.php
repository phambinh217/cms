<?php 

namespace Phambinh\Cms\Widgets;

use Phambinh\Cms\Support\Abstracts\Widget as AbstractWidget;
use Phambinh\Cms\User;

class UserBoxData extends AbstractWidget
{
    public function run($params = null)
    {
    	$data['total'] = User::count();
        return view('Cms::widgets.box-data', $data);
    }
}
