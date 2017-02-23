@extends('Cms::layouts.default',[
	'active_admin_menu' 	=> ['user', isset($user_id) ? 'user.all' : 'user.create'],
	'breadcrumbs' 			=> [
		'title'	=> ['Người dùng', isset($user_id) ? 'Chỉnh sửa' : 'Thêm mới'],
		'url'	=> [
			admin_url('user'),
			admin_url('user'),
		],
	],
])

@section('page_title', isset($user_id) ? 'Chỉnh sửa người dùng' : 'Thêm người dùng mới')

@if(isset($user_id))
	@section('page_sub_title', $user->full_name)
	@can('admin.user.create')
		@section('tool_bar')
			<a href="{{ route('admin.user.create') }}" class="btn btn-primary">
				<i class="fa fa-plus"></i> <span class="hidden-xs">Thêm người dùng mới</span>
			</a>
		@endsection
	@endcan
@endif

@section('content')

	<form ajax-form-container action="{{ isset($user_id) ? admin_url('user/' . $user_id)  : admin_url('user') }}" method="post" class="form-horizontal form-bordered form-row-stripped">
		@if(isset($user_id))
			<input type="hidden" name="_method" value="PUT" />
		@endif
		{{ csrf_field() }}
		<div class="form-body">
			<div class="form-group">
				<label class="control-label col-sm-3 pull-left">
					Họ và tên đệm <span class="required">*</span>
				</label>
				<div class="col-sm-7">
					<input value="{{ $user->last_name or '' }}" name="user[last_name]" type="text" placeholder="" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3 pull-left">
					Tên thật <span class="required">*</span>
				</label>
				<div class="col-sm-7">
					<input value="{{ $user->first_name or '' }}" name="user[first_name]" type="text" placeholder="" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3 pull-left">
					Bí danh <span class="required">*</span>
				</label>
				<div class="col-sm-7">
					<input value="{{ $user->name or '' }}"  name="user[name]" type="text" placeholder="" class="form-control" />
					<span class="help-block"> Một tên ngắn gọn, không bao gồm dấu cách và các ký tự đặc biệt </span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3 pull-left">
					Số điện thoại <span class="required">*</span>
				</label>
				<div class="col-sm-7">
					<input value="{{ $user->phone or '' }}" name="user[phone]" type="text" placeholder="" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3 pull-left">Ngày sinh</label>
				<div class="col-sm-7">
					<input value="{{ isset($user_id) ? changeFormatDate($user->birth, 'Y-m-d', 'd-m-Y') : '' }}" name="user[birth]" type="text" class="form-control" placeholder="Ví dụ: 21-07-1996">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3 pull-left">
					Địa chỉ email <span class="required">*</span>
				</label>
				<div class="col-sm-7">
					<input value="{{ $user->email or '' }}" name="user[email]" type="text" placeholder="" class="form-control">
					<span class="help-block"> Địa chỉ email sẽ dùng để đăng nhập tài khoản </span>
				</div>
			</div>
			
			<div class="form-group">
                <label class="control-label col-sm-3">Giới thiệu</label>
                <div class="col-sm-7">
                    <textarea name="user[about]" class="form-control" rows="3" placeholder="">{{ $user->about }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Facebook</label>
                <div class="col-sm-7">
                    <input name="user[facebook]" value="{{ $user->facebook }}" type="text" placeholder="fb.com/xxx" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Google plus</label>
                <div class="col-sm-7">
                    <input name="user[google_plus]" value="{{ $user->google_plus }}" type="text" placeholder="" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Website Url</label>
                <div class="col-sm-7">
                    <input name="user[website]" value="{{ $user->website }}" type="text" placeholder="google.com" class="form-control">
                </div>
            </div>

			@if(! isset($user_id))
				<div class="form-group">
					<label class="control-label col-sm-3 pull-left">
						Mật khẩu <span class="required">*</span>
					</label>
					<div class="col-sm-7">
						<input name="user[password]" type="password" placeholder="" class="form-control">
						<span class="help-block"> Mật khẩu này sử dụng để đăng nhập tài khoản </span>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3 pull-left">
						Xác nhận mật khẩu <span class="required">*</span>
					</label>
					<div class="col-sm-7">
						<input name="user[password_confirmation]" type="password" placeholder="" class="form-control">
						<span class="help-block"> Xác nhận lại mật khẩu </span>
					</div>
					<div class="col-sm-2">
						<div class="mt-checkbox-list">
							<label class="mt-checkbox mt-checkbox-outline"> Hiển thị mật khẩu
								<input type="checkbox" name="test" view-password />
								<span></span>
							</label>
						</div>
					</div>
				</div>
			@endif
			
			<div class="form-group media-box-group">
                <label class="control-label col-md-3">Tải lên ảnh đại diện</label>
                <div class="col-sm-7">
                    @include('Cms::components.form-chose-media', [
                        'name'              => 'user[avatar]',
                        'value'             => old('user.avatar', $user->avatarOrDefault()),
                        'url_image_preview' => old('user.avatar', thumbnail_url($user->avatarOrDefault(), ['width' => '100', 'height' => '100']))
                    ])
                </div>
            </div>

			<div class="form-group last">
				<label class="control-label col-sm-3 pull-left">
					Quyền quản trị <span class="required">*</span>
				</label>
				<div class="col-sm-7">
					@include('Cms::components.form-select-role', [
						'roles' 	=> \Packages\Cms\Role::get(),
						'name'		=> 'user[role_id]',
						'selected' 	=> isset($user_id) ? $user->role_id : NULL,
						'class'		=> 'width-auto',
					])
				</div>
			</div>

			<div class="form-group last">
				<label class="control-label col-sm-3 pull-left">
					Trạng thái <span class="required">*</span>
				</label>
				<div class="col-sm-7">
					@include('Cms::components.form-select-status', [
						'status'	=> \Packages\Cms\User::getStatusAble(),
						'name' 		=> 'user[status]',
						'class'		=> 'width-auto',
						'selected' 	=> isset($user_id) ? ($user->status == 1 ? 'enable' : 'disable') : null,
					])
				</div>
			</div>

		</div>
		<div class="form-actions util-btn-margin-bottom-5">
			<div class="row">
				<div class="col-md-offset-3 col-md-9">
					@if(! isset($user_id))
						@include('Cms::components.btn-save-new')
					@else
						@include('Cms::components.btn-save-out')
					@endif
				</div>
			</div>
		</div>
	</form>

@endsection

@push('css')
	<link href="{{ url('assets/admin/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@push('js_footer')
	<script type="text/javascript" src="{{ url('assets/admin/global/plugins/jquery-form/jquery.form.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/admin/global/plugins/bootstrap-toastr/toastr.min.js') }}"></script>
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
