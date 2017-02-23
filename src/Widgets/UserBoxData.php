<?php 

namespace Packages\Cms\Widgets;

use Packages\Cms\Support\Abstracts\Widget as AbstractWidget;
use Packages\Cms\User;

class UserBoxData extends AbstractWidget
{
    public function run($params = null)
    {
    	$data['total'] = User::count();
        return view('Cms::widgets.box-data', $data);
    }
}
