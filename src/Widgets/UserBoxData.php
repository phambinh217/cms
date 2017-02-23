<?php 

namespace Phambinh\Cms\Widgets;

use Phambinh\Cms\Support\Abstracts\Widget as AbstractWidget;

class UserBoxData extends AbstractWidget
{
    public function run($params = null)
    {
        return view('Cms::widgets.box-data');
    }
}
