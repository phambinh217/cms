@extends('Cms::layouts.default', [
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
    <form class="form-horizontal ajax-form" method="POST" action="">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT" />
        <p>Đổi mật khẩu đăng nhập. Khi đổi thì sẽ đổi cả <code>token_api</code></p>
        <div class="form-group{{$errors->has('user.old_pasword') ? ' has-error' : ''}}">
            <label class="control-lalel col-sm-3 pull-left">
                Mật khẩu cũ <i>(bắt buộc)</i>
            </label>
            <div class="col-sm-3">
                <input type="password" name="user[old_pasword]" value="" class="form-control">
                @if($errors->has('user.old_pasword'))
                    <span class="help-block">
                        {{$errors->first('user.old_pasword')}}
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{$errors->has('user.password') ? ' has-error' : ''}}">
            <label class="control-lalel col-sm-3 pull-left">
                Mật khẩu mới <i>(bắt buộc)</i>
            </label>
            <div class="col-sm-3">
                <input type="password" name="user[password]" value="" class="form-control">
                @if($errors->has('user.password'))
                    <span class="help-block">
                        {{$errors->first('user.password')}}
                    </span>
                @endif
            </div>
            {{-- <div class="col-sm-2">
                <button class="btn btn-default btn-sm" auto-password>Auto password</button>
            </div> --}}
        </div>
        <div class="form-group{{$errors->has('user.password_confirmation') ? ' has-error' : ''}}">
            <label class="control-lalel col-sm-3 pull-left">
                Mật khẩu mới <i>(bắt buộc)</i>
            </label>
            <div class="col-sm-3">
                <input type="password" name="user[password_confirmation]" value="" class="form-control">
                <label class="mt-checkbox mt-checkbox-outline"> 
                    <input type="checkbox" view-password />
                    Hiển thị mật khẩu
                </label>
                @if($errors->has('user.password_confirmation'))
                    <span class="help-block">
                        {{$errors->first('user.password_confirmation')}}
                    </span>
                @endif
            </div>
        </div>
        <button class="btn btn-primary">
            <i class="fa fa-check"></i> Lưu thay đổi
        </button>
    </form>
@endsection

@push('css')
    <link href="{{ asset_url('admin', 'global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@push('js_footer')
    <script type="text/javascript" src="{{ asset_url('admin', 'global/plugins/jquery-form/jquery.form.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_url('admin', 'global/plugins/bootstrap-toastr/toastr.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $('*[view-password]').change(function(){
                if(this.checked) {
                    $('*[name="user[password]"]').attr('type','text');
                    $('*[name="user[password_confirmation]"]').attr('type','text');
                } else {
                    $('*[name="user[password]"]').attr('type','password');
                    $('*[name="user[password_confirmation]"]').attr('type','password');
                }
            });
        });
    </script>
@endpush
