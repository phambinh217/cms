<?php 

namespace Phambinh\Cms\Api\Http\Controllers;

use Illuminate\Http\Request;
use ApiController;

class HelperController extends ApiController
{
    public function bcrypt(Request $request)
    {
        $code = $request->input;
        return response()->json($code, 200);
    }

    public function str_random(Request $request)
    {
        $number = '8';
        if (! empty($request->number)) {
            $number = $request->number;
        }

        $str = str_random($number);
        return response()->json($str, 200);
    }

    public function str_slug(Request $request)
    {
        $string = $request->input;
        $slug = str_slug($string);
        return response()->json($slug, 200);
    }
}
