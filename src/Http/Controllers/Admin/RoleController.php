<?php

namespace Phambinh\Cms\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Validator;
use Phambinh\Cms\User;
use Phambinh\Cms\Role;
use Phambinh\Cms\Permission;

class RoleController extends AdminController
{
    public function index()
    {
        \Metatag::set('title', 'Danh sách vai trò');

        $filter = Role::getRequestFilter();
        $roles = Role::ofQuery($filter)
            ->select('roles.*')
            ->addSelect(\DB::raw('count(users.id) as total_user'))
            ->leftjoin('users', 'users.role_id', '=', 'roles.id')
            ->groupBy('roles.id')
            ->paginate($this->paginate);

        $this->data['roles'] = $roles;
        $this->data['filter'] = $filter;

        return view('Cms::admin.role.list', $this->data);
    }

    public function create()
    {
        \Metatag::set('title', 'Thêm vai trò mới');

        $role = new Role();
        $this->data['role'] = $role;

        return view('Cms::admin.role.save', $this->data);
    }

    public function edit(Role $role)
    {
        \Metatag::set('title', 'Chỉnh sửa vai trò');

        $this->data['role'] = $role;
        $this->data['role_id'] = $role->id;

        return view('Cms::admin.role.save', $this->data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'role.name'    =>    'required',
            'role.type'    =>    'required|in:0,*,option',
            'role.permission' => 'required_if:role.type,option',
        ]);

        \AccessControl::forgetCache();

        $role = new Role();
        $role->fill($request->role);
        $role->save();

        if ($role->isOption()) {
            if (isset($request->role['permission']) && count($request->role['permission'])) {
                foreach ($request->role['permission'] as $perm) {
                    $permission = new Permission(['permission' => $perm ]);
                    $role->permissions()->save($permission);
                }
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'title'        =>    'Thành công',
                'message'    =>    'Thành công',
                'redirect'    =>    isset($request->save_only) ?
                    route('admin.role.edit', ['id' => $role->id]) :
                    route('admin.role.create'),
            ], 200);
        }

        if (isset($request->save_only)) {
            return redirect(route('admin.role.edit', ['id' => $role->id]));
        }

        return redirect(route('admin.role.create'));
    }

    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'role.name'    =>    'required',
            'role.type'    =>    'required|in:0,*,option',
            'role.permission' => 'required_if:role.type,option',
        ]);

        \AccessControl::forgetCache();
        
        $role->fill($request->role);
        $role->save();
        
        $role->permissions()->delete();

        if ($role->isOption()) {
            if (isset($request->role['permission']) && count($request->role['permission'])) {
                foreach ($request->role['permission'] as $perm) {
                    $permission = new Permission(['permission' => $perm ]);
                    $role->permissions()->save($permission);
                }
            }
        }

        if ($request->ajax()) {
            $response = [
                'title'        =>    'Thành công',
                'message'    =>    'Thành công',
            ];
            if (isset($request->save_and_out)) {
                $response['redirect'] = route('admin.role.index');
            }

            return response()->json($response, 200);
        }
        
        if (isset($request->save_and_out)) {
            return redirect()->route('admin.role.index');
        }
                
        return redirect()->back();
    }

    public function destroy(Request $request, Role $role)
    {
        if ($role->users->count()) {
            if ($request->ajax()) {
                return response()->json([
                    'title'        =>    'Lỗi',
                    'message'    =>    'Vai trò này đã có thành viên'
                ], 402);
            }

            return redirect()->back();
        }

        $role->delete();

        if ($request->ajax()) {
            return response()->json([
                'title'        =>    'Thành công',
                'message'    =>    'Thành công',
            ], 200);
        }
        
        return redirect()->back();
    }
}
