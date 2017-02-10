<?php

namespace Phambinh\Cms\Setting\Http\Controllers\Admin;

use Illuminate\Http\Request;
use AdminController;
use Validator;

class SettingController extends AdminController
{
    public function general()
    {
        $this->data['company_name'] = setting('company-name');
        $this->data['company_address'] = setting('company-address');
        $this->data['company_phone'] = setting('company-phone');
        $this->data['company_email'] = setting('company-email');
        $this->data['home_title'] = setting('home-title');
        $this->data['home_description'] = setting('home-description');
        $this->data['home_keyword'] = setting('home-keyword');
        $this->data['logo'] = setting('logo', url('logo.png'));

        \Metatag::set('title', 'Cài đặt chung');
        return view('Setting::admin.setting.general', $this->data);
    }

    public function generalUpdate(Request $request)
    {
        $this->validate($request, [
            'company_name' => 'required',
            'company_phone' => 'required',
            'company_email' => 'required',
            'company_address' => 'required',
            'home_title' => '',
            'home_keyword' => '',
            'home_description' => '',
            'logo' => '',
        ]);

        setting()->sync('company-name', $request->input('company_name'));
        setting()->sync('company-email', $request->input('company_email'));
        setting()->sync('company-phone', $request->input('company_phone'));
        setting()->sync('company-address', $request->input('company_address'));

        setting()->sync('home-title', $request->input('home_title'));
        setting()->sync('home-description', $request->input('home_description'));
        setting()->sync('home-keyword', $request->input('home_keyword'));
        setting()->sync('logo', $request->input('logo'));

        if ($request->ajax()) {
            return response()->json([
                'title' => 'Thành công',
                'message' => 'Đã lưu cài đặt',
            ]);
        }

        return redirect()->back();
    }

    public function checkVersion()
    {
        // $url = 'https://api.github.com/repos/phambinh217/cms/commits?since=2017-02-10T00:00:00Z';
        // $response = \Curl::to($url)
        //     ->withOption('USERAGENT', 'spider')
        //     ->asJson()
        //     ->get();

        // $data = array_first($response);

        // dd($data->sha);

        \Metatag::set('title', 'Kiểm tra phiên bản');
        return view('Setting::admin.setting.check-version', $this->data);
    }
}
