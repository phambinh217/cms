@extends('Cms::layouts.default', [
    'active_admin_menu' => ['profile', 'profile.info'],
    'breadcrumbs'   =>  [
        'title' =>  ['Cá nhân', 'Thông tin cá nhân'],
        'url'   =>  [
            admin_url('profile'),
            admin_url('profile'),
        ],
    ],
])

@section('page_title', 'Trang cá nhân')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="profile-sidebar">
            <div class="portlet light profile-sidebar-portlet bordered">
                <div class="profile-userpic">
                    <img src="{{ thumbnail_url($user->avatarOrDefault(), ['width' => '100', 'height' => '100']) }}" class="img-responsive" alt=""> </div>
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> {{ $user->full_name }} </div>
                    <div class="profile-usertitle-job"> {{ $user->role()->first()->name }} </div>
                </div>
                <div class="profile-userbuttons">
                    <button onclick="event.preventDefault();document.getElementById('logout-form').submit();" type="button" class="btn btn-circle red btn-sm">Đăng xuất</button>
                </div>
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li>
                            <a href="{{ admin_url('profile') }}">
                                <i class="icon-info"></i> Thông tin cá nhân
                            </a>
                        </li>
                        <li>
                            <a href="{{ admin_url('profile/change-password') }}">
                                <i class="icon-key"></i> Đổi mật khẩu
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold">Về {{ $user->full_name }}</span>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <span class="profile-desc-text">
                        {{ $user->about }}
                    </span>
                    @if(! empty($user->website))
                        <div class="margin-top-20 profile-desc-link">
                            <i class="fa fa-globe"></i>
                            <a href="{{ $user->website }}">{{ $user->website }}</a>
                        </div>
                    @endif
                    @if(! empty($user->email))
                        <div class="margin-top-20 profile-desc-link">
                            <i class="fa fa-envelope"></i>
                            <a href="{{ $user->email }}">{{ $user->email }}</a>
                        </div>
                    @endif
                    @if(! empty($user->facebook))
                        <div class="margin-top-20 profile-desc-link">
                            <i class="fa fa-facebook"></i>
                            <a href="{{ $user->facebook }}">{{ $user->facebook }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered form-fit">
                        <div class="portlet-title with-tab">
                            <div class="tab-default">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab_1_1" data-toggle="tab">Thông tin cá nhân</a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_2" data-toggle="tab">Đổi ảnh đại diện</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form method="post" class="form-horizontal form-bordered form-row-stripped ajax-form">
                                <input type="hidden" name="_method" value="PUT" />
                                {{ csrf_field() }} 
                                <div class="form-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1_1">
                                            
                                            <div class="form-group">
                                                <label class="control-label col-sm-3">Họ và tên đệm</label>
                                                <div class="col-sm-9">
                                                    <input name="user[last_name]" value="{{ $user->last_name }}" type="text" placeholder="" class="form-control" />
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label class="control-label col-sm-3">Tên</label>
                                                <div class="col-sm-9">
                                                    <input name="user[first_name]" value="{{ $user->first_name }}" type="text" placeholder="" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3">Số điện thoại</label>
                                                <div class="col-sm-9">
                                                    <input name="user[phone]" value="{{ $user->phone }}" type="text" placeholder="" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3">Email</label>
                                                <div class="col-sm-9">
                                                    <input name="user[email]" value="{{ $user->email }}" type="text" placeholder="" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3 pull-left">Ngày sinh</label>
                                                <div class="col-sm-7">
                                                    <input value="{{ changeFormatDate($user->birth, 'Y-m-d', 'd-m-Y') }}" name="user[birth]" type="text" class="form-control" placeholder="Ví dụ: 21-07-1996">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3">Công việc hiện tại</label>
                                                <div class="col-sm-9">
                                                    <input name="user[job]" value="{{ $user->job }}" type="text" placeholder="" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3">Địa chỉ</label>
                                                <div class="col-sm-9">
                                                    <textarea name="user[address]" class="form-control" rows="3" placeholder="">{{ $user->address }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3">Giới thiệu</label>
                                                <div class="col-sm-9">
                                                    <textarea name="user[about]" class="form-control" rows="3" placeholder="">{{ $user->about }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3">Facebook</label>
                                                <div class="col-sm-9">
                                                    <input name="user[facebook]" value="{{ $user->facebook }}" type="text" placeholder="fb.com/xxx" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3">Google plus</label>
                                                <div class="col-sm-9">
                                                    <input name="user[google_plus]" value="{{ $user->google_plus }}" type="text" placeholder="" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3">Website Url</label>
                                                <div class="col-sm-9">
                                                    <input name="user[website]" value="{{ $user->website }}" type="text" placeholder="google.com" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab_1_2">
                                            <div class="form-group media-box-group">
                                                <label class="control-label col-md-3">Tải lên ảnh đại diện</label>
                                                <div class="col-sm-9">
                                                    @include('Cms::components.form-chose-media', [
                                                        'name'              => 'user[avatar]',
                                                        'value'             => old('user.avatar', $user->avatarOrDefault()),
                                                        'url_image_preview' => old('user.avatar', thumbnail_url($user->avatarOrDefault(), ['width' => '100', 'height' => '100']))
                                                    ])
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions util-btn-margin-bottom-5">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-primary full-width-xs">
                                                <i class="fa fa-check"></i> Lưu thay đổi
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
    <link href="{{ asset_url('admin', 'global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset_url('admin', 'pages/css/profile.css')}}" rel="stylesheet" type="text/css" />
@endpush

@push('js_footer')
	<script type="text/javascript" src="{{ asset_url('admin', 'global/plugins/jquery-form/jquery.form.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_url('admin', 'global/plugins/bootstrap-toastr/toastr.min.js') }}"></script>
@endpush
