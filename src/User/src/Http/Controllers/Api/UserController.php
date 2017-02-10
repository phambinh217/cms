<?php 

namespace Phambinh\Cms\User\Http\Controllers\Api;

use Illuminate\Http\Request;
use ApiController;
use Phambinh\Cms\User\Models\User;

class UserController extends ApiController
{
    public function index()
    {
        $User = new User();
        $filter = $User->getRequestFilter();
        $res = $User
            ->distinct()
            ->ofQuery($filter)
            ->select('users.*')
            ->get();

        return response()->json($res, 200);
    }
}
