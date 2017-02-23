<?php 

namespace Phambinh\Cms\Http\Controllers\Admin;

use Illuminate\Http\Request;

use AdminController;
use Auth;
use Validator;

class ProfileController extends AdminController
{
    /**
     * Hiển thị thông tin cá nhân
     */
    public function show()
    {
        \Metatag::set('title', 'Trang cá nhân');

        $this->data['user'] = Auth::user();

        return view('Cms::admin.profile.show', $this->data);
    }

    /**
     * Hiển thị trang chỉnh sửa thông tin cá nhân
     */
    public function edit()
    {
        \Metatag::set('title', 'Chỉnh sửa trang cá nhân');

        $this->data['user'] = Auth::user();

        return view('Cms::admin.profile.edit', $this->data);
    }

    /**
     *
     * Cập nhật trang cá nhân
     *
     * @param
     * @return
     * @author BinhPham
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'user.first_name'    =>    'required|max:255',
            'user.last_name'    =>    'required|max:255',
            'user.birth'        =>  'required|date_format:d-m-Y',
            'user.phone'        =>    'max:255',
            'user.about'        =>    'max:500',
            'user.facebook'        =>    'max:255',
            'user.website'        =>    'max:255',
            'user.job'            =>    'max:255',
            'user.google_plus'    =>    'max:255',
            'user.address' => 'max:300',
        ]);

        Auth::user()->fill($request->user);
        Auth::user()->birth = changeFormatDate($request->user['birth'], 'd-m-Y', 'Y-m-d');
        Auth::user()->save();

        if ($request->ajax()) {
            return response()->json([
                'title'        =>    'Updated',
                'message'    =>    'Updated',
            ], 200);
        }

        return redirect()->back();
    }

    /**
     * Hiển thị trang thay đổi mật khẩu
     */
    public function changePassword()
    {
        \Metatag::set('title', 'Đổi mật khẩu');

        $this->data['user'] = Auth::user();

        return view('Cms::admin.profile.change-password', $this->data);
    }

    /**
     *
     * Thay đổi mật khẩu
     *
     * @param
     * @return
     * @author BinhPham
     */
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'user.old_pasword'                =>    'required|hash:' . Auth::user()->password,
            'user.password'                    =>    'required|confirmed',
            'user.password_confirmation'    =>    'required',
        ]);

        Auth::user()->password = bcrypt($request->user['password']);
        Auth::user()->save();
        
        if ($request->ajax()) {
            return response()->json([
                'title'    => 'Changed',
                'message'    => 'Changed',
                'redirect'    =>    admin_url('profile'),
            ], 200);
        }

        return redirect()->back();
    }
}
