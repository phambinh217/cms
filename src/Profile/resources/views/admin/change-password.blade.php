@extends('Admin::layouts.default', [
    'active_admin_menu' => ['profile', 'profile.change-password'],
    'breadcrumbs'   =>  [
        'title' =>  ['Cá nhân', 'Đổi mật khẩu'],
        'url'   =>  [
            admin_url('profile'),
            admin_url('profile/change-password'),
        ],
    ],
])

@section('page_title', 'Đổi mật khẩu')

@section('content')
    <form ajax-form-container class="form-horizontal" method="POST" action="">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT" />
        <p>Đổi mật khẩu đăng nhập</p>
        <div class="form-group{{$errors->has('user.old_pasword') ? ' has-error' : ''}}">
            <label class="control-lalel col-sm-3 pull-left">
                <strong>Mật khẩu cũ <i>(bắt buộc)</i></strong>
            </label>
            <div class="col-sm-3">
                <input type="password" name="user[old_pasword]" value="" class="form-control input-sm">
                @if($errors->has('user.old_pasword'))
                    <span class="help-block">
                        <strong>{{$errors->first('user.old_pasword')}}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{$errors->has('user.password') ? ' has-error' : ''}}">
            <label class="control-lalel col-sm-3 pull-left">
                <strong>Mật khẩu mới <i>(bắt buộc)</i></strong>
            </label>
            <div class="col-sm-3">
                <input type="password" name="user[password]" value="" class="form-control input-sm">
                @if($errors->has('user.password'))
                    <span class="help-block">
                        <strong>{{$errors->first('user.password')}}</strong>
                    </span>
                @endif
            </div>
            {{-- <div class="col-sm-2">
                <button class="btn btn-default btn-sm" auto-password>Auto password</button>
            </div> --}}
        </div>
        <div class="form-group{{$errors->has('user.password_confirmation') ? ' has-error' : ''}}">
            <label class="control-lalel col-sm-3 pull-left">
                <strong>Mật khẩu mới <i>(bắt buộc)</i></strong>
            </label>
            <div class="col-sm-3">
                <input type="password" name="user[password_confirmation]" value="" class="form-control input-sm">
                @if($errors->has('user.password_confirmation'))
                    <span class="help-block">
                        <strong>{{$errors->first('user.password_confirmation')}}</strong>
                    </span>
                @endif
            </div>
            {{-- <div class="col-sm-2">
                <div class="mt-checkbox-list">
                    <label class="mt-checkbox mt-checkbox-outline"> Display password
                        <input type="checkbox" value="admin_base_action" name="test" view-password />
                        <span></span>
                    </label>
                </div>
            </div> --}}
        </div>

        <button class="btn btn-primary btn-sm">
            <i class="fa fa-check"></i> Lưu thay đổi
        </button>
    </form>
@endsection

@push('css')
    <link href="{{ url('assets/admin/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@push('js_footer')
    <script type="text/javascript" src="{{ url('assets/admin/global/plugins/jquery-form/jquery.form.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/admin/global/plugins/bootstrap-toastr/toastr.min.js') }}"></script>
@endpush
