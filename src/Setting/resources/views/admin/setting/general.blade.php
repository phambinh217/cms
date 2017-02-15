@extends('Admin::layouts.default',[
	'active_admin_menu' 	=> ['setting', 'setting.general'],
	'breadcrumbs' 			=> [
		'title'	=> ['Cài đặt', 'Chung'],
		'url'	=> [route('admin.setting.general')],
	],
])

@section('page_title', 'Cài đặt chung')

@section('content')
	<form class="form-horizontal ajax-form" method="POST" action="{{ route('admin.setting.general.update') }}">
		{{ csrf_field() }}
		{{ method_field('PUT') }}
		<div class="form-body">
			<fieldset>
				<legend>Thông tin công ty</legend>
				<div class="form-group">
					<label class="control-lalel col-sm-3 pull-left">
						Tên công ty
					</label>
					<div class="col-sm-3">
						<input type="text" name="company_name" class="form-control" value="{{ $company_name }}" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-lalel col-sm-3 pull-left">
						Số điện thoại công ty
					</label>
					<div class="col-sm-3">
						<input type="text" name="company_phone" class="form-control" value="{{ $company_phone }}" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-lalel col-sm-3 pull-left">
						Email công ty
					</label>
					<div class="col-sm-3">
						<input type="text" name="company_email" class="form-control" value="{{ $company_email }}" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-lalel col-sm-3 pull-left">
						Địa chỉ công ty
					</label>
					<div class="col-sm-3">
						<textarea name="company_address" class="form-control" >{{ $company_address }}</textarea>
					</div>
				</div>
				<div class="form-group media-box-group">
					<label class="control-lalel col-sm-3 pull-left">
						Logo công ty
					</label>
					<div class="col-sm-9">
						@include('Admin::admin.components.form-chose-media', [
                            'name'              => 'logo',
                            'value'             => old('logo', $logo),
                            'url_image_preview' => old('logo', $logo),
                        ])
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend>Tối ưu máy tìm kiếm</legend>
				<div class="form-group">
					<label class="control-lalel col-sm-3 pull-left">
						Meta title trang chủ
					</label>
					<div class="col-sm-3">
						<input type="text" name="home_title" class="form-control" value="{{ $home_title }}" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-lalel col-sm-3 pull-left">
						Meta keyword
					</label>
					<div class="col-sm-3">
						<input type="text" name="home_keyword" class="form-control" value="{{ $home_keyword }}" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-lalel col-sm-3 pull-left">
						Meta description trang chủ
					</label>
					<div class="col-sm-3">
						<textarea name="home_description" class="form-control">{{ $home_description }}</textarea>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend>Hình ảnh</legend>
				<div class="form-group media-box-group">
					<label class="control-lalel col-sm-3 pull-left">
						Thumbnail mặc định
					</label>
					<div class="col-sm-9">
						@include('Admin::admin.components.form-chose-media', [
                            'name'              => 'default_thumbnail',
                            'value'             => old('default_thumbnail', $default_thumbnail),
                            'url_image_preview' => old('default_thumbnail', $default_thumbnail),
                        ])
					</div>
				</div>
				<div class="form-group media-box-group">
					<label class="control-lalel col-sm-3 pull-left">
						Avatar mặc định
					</label>
					<div class="col-sm-9">
						@include('Admin::admin.components.form-chose-media', [
                            'name'              => 'default_avatar',
                            'value'             => old('default_thumbnail', $default_avatar),
                            'url_image_preview' => old('default_thumbnail', $default_avatar),
                        ])
					</div>
				</div>
			</fieldset>
		</div>
		<div class="form-actions util-btn-margin-bottom-5">
			<button class="btn btn-primary full-width-xs">
				<i class="fa fa-save"></i> Lưu cài đặt
			</button>
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
			$('#confirm-order').change(function(){
    			if ($(this).val() == 'true') {
    				$('#order-status-not-confirm').show();
    			} else {
    				$('#order-status-not-confirm').hide();
    			}
    		});

			$('#order-notify-email').change(function(){
    			if ($(this).val() == 'true') {
    				$('#order-notify-email-user-role').show();
    			} else {
    				$('#order-notify-email-user-role').hide();
    			}
    		});
		});
	</script>
@endpush
