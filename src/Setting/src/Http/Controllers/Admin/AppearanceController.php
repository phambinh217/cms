<?php

namespace Phambinh\Cms\Setting\Http\Controllers\Admin;

use Illuminate\Http\Request;
use AdminController;
use Validator;
use Phambinh\Cms\Setting\Models\Menu;
use Phambinh\Cms\Setting\Models\MenuItem;

class AppearanceController extends AdminController
{
    public function menu()
    {
        $this->data['menus'] = Menu::get();
        $this->data['menu_items'] = MenuItem::get();

        \Metatag::set('title', 'Cài đặt menu');
        return view('Setting::admin.setting.menu', $this->data);
    }

    public function menuUpdate()
    {
    }

    public function menuStore(Request $request)
    {
        $this->validate($request, [
            'menu.name' => 'required',
            'menu.slug' => '',
        ]);

        $menu = new Menu();
        $menu->fill($request->input('menu'));
        
        if (!empty($menu->slug)) {
            $menu->slug = str_slug($menu->name);
        }

        $menu->save();

        if ($request->ajax()) {
            return response()->json([
                'title' => 'Thành công',
                'message' => 'Đã thêm menu mới',
                'redirect' => route('admin.setting.appearance.menu'),
            ]);
        }

        return reidrect()->back();
    }

    public function menuAdd(Request $request, $id)
    {
        $this->validate($request, [
            'object_id' => 'required',
            'type' => 'required',
        ]);

        $type = $request->input('type');
        $objects = $type::whereIn('id', $request->input('object_id'))->get();

        foreach ($objects as $object) {
            $object->addToMenu($id);
        }

        if ($request->ajax()) {
            return response()->json([
                'title' => 'Thành công',
                'message' => 'Đã thêm vào menu',
                'redirect' => route('admin.setting.appearance.menu'),
            ]);
        }

        return redirect()->back();
    }

    public function menuAddByDefault(Request $request, $id)
    {
        $this->validate($request, [
            'menu_item.title' => 'required',
            'menu_item.url' => '',
        ]);

        $menu = Menu::find($id);
        $menu->items()->create($request->input('menu_item'));

        if ($request->ajax()) {
            return response()->json([
                'title' => 'Thành công',
                'message' => 'Đã thêm vào menu',
                'redirect' => route('admin.setting.appearance.menu'),
            ]);
        }

        return redirect()->back();
    }
}
