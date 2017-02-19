<?php

namespace Phambinh\Cms\User\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Validator;
use AdminController;
use Phambinh\Cms\User\Models\User;

class UserController extends AdminController
{
    public function index()
    {
        \Metatag::set('title', 'Danh sách người dùng');

        $filter = User::getRequestFilter();
        $users = User::select('users.*', 'roles.name as role_name')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->ofQuery($filter)->paginate($this->paginate);
        
        $this->data['users']    = $users;
        $this->data['filter']   = $filter;

        return view('User::admin.list', $this->data);
    }

    public function show(User $user)
    {
        if ($user->isSelf()) {
            return redirect()->route('admin.profile.show');
        }
        
        \Metatag::set('title', 'Xem chi tiết người dùng');
        $this->data['user'] = $user;
        $this->data['user_id'] = $user->id;

        return view('User::admin.show', $this->data);
    }

    public function popupShow(User $user)
    {
        $this->data['user'] = $user;
        $this->data['user_id'] = $user->id;

        return view('User::admin.popup-show', $this->data);
    }
    
    public function create()
    {
        \Metatag::set('title', 'Thêm người dùng');

        $user = new User();
        $this->data['user'] = $user;

        return view('User::admin.save', $this->data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user.name'                    => 'required|unique:users,name',
            'user.phone'                    => 'required|unique:users,phone',
            'user.email'                    => 'required|email|max:255|unique:users,email',
            'user.last_name'                => 'required|max:255',
            'user.first_name'                => 'required|max:255',
            'user.birth'                    => 'required|date_format:d-m-Y',
            'user.password'                => 'required|confirmed',
            'user.password_confirmation'    => 'required',
            'user.role_id'                    => 'required|exists:roles,id',
            'user.status'                    => 'required|in:enable,disable',
            'user.about'                    =>    'max:500',
            'user.facebook'                    =>    'max:255',
            'user.website'                    =>    'max:255',
            'user.job'                        =>    'max:255',
            'user.google_plus'                =>    'max:255',
        ]);

        $user = new User();
        $user->fill($request->user);
        $user->birth = changeFormatDate($user->birth, 'd-m-Y', 'Y-m-d');
        $user->password = bcrypt($user->password);
        
        switch ($user->status) {
            case 'disable':
                $user->status = '0';
                break;

            case 'enable':
                $user->status = '1';
                break;
        }

        $user->save();

        if ($request->ajax()) {
            return response()->json([
                'title'        =>    'Thành công',
                'message'    =>    'Thành công',
                'redirect'    =>    isset($request->save_only) ?
                    route('admin.user.edit', ['id' => $user->id]) :
                    route('admin.user.create'),
            ], 200);
        }

        if (isset($request->save_only)) {
            return redirect(route('admin.user.edit', ['id' => $user->id]));
        }

        return redirect(route('admin.user.create'));
    }

    public function edit(User $user)
    {
        \Metatag::set('title', 'Chỉnh sửa người dùng');

        // Không thể tự chỉnh sửa thông tin của bản thân trong phương thức này
        // Sẽ tự đi vào trang cá nhân
        if ($user->isSelf()) {
            return redirect(route('admin.profile.show'));
        }

        $this->data['user'] = $user;
        $this->data['user_id'] = $user->id;

        return view('User::admin.save', $this->data);
    }

    public function update(Request $request, User $user)
    {
        if ($user->isSelf()) {
            return response()->json([], 422);
        }

        $this->validate($request, [
            'user.last_name'                => 'required|max:255',
            'user.first_name'                => 'required|max:255',
            'user.birth'                    => 'required|date_format:d-m-Y',
            'user.phone'                    => 'required|unique:users,phone,'.$user->id.',id',
            'user.email'                    => 'required|email|max:255|unique:users,email,'.$user->id.',id',
            'user.role_id'                    => 'required|exists:roles,id',
            'user.status'                    => 'required|in:enable,disable',
            'user.about'                    =>    'max:500',
            'user.facebook'                    =>    'max:255',
            'user.website'                    =>    'max:255',
            'user.job'                        =>    'max:255',
            'user.google_plus'                =>    'max:255',
        ]);

        $user->fill($request->user);
        $user->birth = changeFormatDate($user->birth, 'd-m-Y', 'Y-m-d');
        
        switch ($user->status) {
            case 'disable':
                $user->status = '0';
                break;

            case 'enable':
                $user->status = '1';
                break;
        }

        $user->save();

        if ($request->ajax()) {
            $response = [
                'title'        =>    'Thành công',
                'message'    =>    'Thành công',
            ];
            if (isset($request->save_and_out)) {
                $response['redirect'] = route('admin.user.index');
            }

            return response()->json($response, 200);
        }
        
        if (isset($request->save_and_out)) {
            return redirect()->route('admin.user.index');
        }
                
        return redirect()->back();
    }

    public function disable(Request $request, User $user)
    {
        // Hành động này không thể áp dụng với bản thân người đang đăng nhập
        if ($user->isSelf()) {
            if ($request->ajax()) {
                return response()->json([

                ], 422);
            }

            return redirect()->back();
        }

        $user->markAsDisable();

        if ($request->ajax()) {
            return response()->json([
                'title'        =>    'Thành công',
                'message'    =>    'Thành công',
            ], 200);
        }

        return redirect()->back();
    }

    public function enable(Request $request, User $user)
    {
        // Hành động này không thể áp dụng với bản thân người đang đăng nhập
        if ($user->isSelf()) {
            if ($request->ajax()) {
                return response()->json([

                ], 422);
            }

            return redirect()->back();
        }

        $user->markAsEnable();

        if ($request->ajax()) {
            return response()->json([
                'title'        =>    'Thành công',
                'message'    =>    'Thành công',
            ], 200);
        }
        
        return redirect()->back();
    }

    public function destroy(Request $request, User $user)
    {
        // Hành động này không thể áp dụng với bản thân người đang đăng nhập
        if ($user->isSelf()) {
            if ($request->ajax()) {
                return response()->json([

                ], 402);
            }

            return redirect()->back();
        }

        if ($user->students->count()) {
            if ($request->ajax()) {
                return response()->json([
                    'title'        =>    'Lỗi',
                    'message'    =>    'Người này có học viên trong hệ thống'
                ], 402);
            }

            return redirect()->back();
        }

        $user->delete();

        if ($request->ajax()) {
            return response()->json([
                'title'        =>    'Thành công',
                'message'    =>    'Thành công',
            ], 200);
        }
        
        return redirect()->back();
    }

    public function loginAs(User $user)
    {
        \Auth::loginUsingId($user->id);

        return redirect(url('/'));
    }
}
