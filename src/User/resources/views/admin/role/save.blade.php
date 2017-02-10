@extends('Admin::layouts.default',[
	'active_admin_menu' 	=> ['user', 'user.role'],
	'breadcrumbs' 			=> [
		'title'	=> ['Người dùng', 'Vai trò', isset($role_id) ?  'Chỉnh sửa' : 'Thêm mới'],
		'url'	=> [
			admin_url('user'),
			admin_url('role'),
		],
	],
])

@section('page_title', isset($role_id) ? 'Chỉnh sửa vai trò quản trị' : 'Thêm vai trò quản trị mới')
@if(isset($role_id))
	@section('tool_bar')
		<a href="{{ route('admin.user.role.create') }}" class="btn btn-primary">
			<i class="fa fa-plus"></i> <span class="hidden-xs">Thêm vai trò mới</span>
		</a>
	@endsection
@endif
@section('content')
	<form ajax-form-container action="{{ isset($role_id) ? admin_url('user/role/' . $role_id) : route('admin.user.role.show', ['id' => $role->id]) }}" method="post" class="form-horizontal form-bordered form-row-stripped">
		
		@if(isset($role_id))
			<input type="hidden" name="_method" value="PUT" />
		@endif

		{{ csrf_field() }}		
		<div class="form-body">
			<div class="form-group">
				<label class="control-label col-sm-3 pull-left">
					Tên quyền <span class="required">*</span>
				</label>
				<div class="col-sm-7">
					<input value="{{ $role->name or '' }}" name="role[name]" type="text" placeholder="" class="form-control">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-3 pull-left">
					Kiểu <span class="required">*</span>
				</label>
				<div class="col-sm-7">
					<select name="role[type]" class="form-control width-auto">
						<option {{ isset($role_id) && $role->type == '*' ? 'selected' : '' }} value="*">Có mọi quyền</option>
						<option {{ isset($role_id) && $role->type == 'option' ? 'selected' : '' }} value="option">Tùy chọn</option>
						<option {{ isset($role_id) && $role->type == '0' ? 'selected' : '' }} value="0">Cấm tất cả</option>
					</select>
				</div>
			</div>

			<div class="permission-list">
				<div class="form-group">
					<label class="control-label col-sm-3 pull-left"></label>
					<div class="col-sm-9">
						<div class="m-heading-1 border-green m-bordered">
							<?php  $access_controls = collect(\AccessControl::all()); ?>
							
							@foreach($access_controls->chunk(3) as $chunks)
								<div class="row">
									@foreach($chunks as $access_item)
										<?php  $check = isset($role_id) && in_array($access_item['name'], \AccessControl::getRole($role->id)) ? 'checked' : '' ; ?>
										<div class="col-sm-4">
					                        <div class="input-group">
					                            <div class="icheck-list">
					                                <label>
					                                    <input {{ $check }} type="checkbox" class="icheck" name="role[permission][]" value="{{ $access_item['name'] }}" /> {{ $access_item['label'] }}
													</label>
					                            </div>
					                        </div>
				                        </div>
			                        @endforeach
		                        </div>
	                        @endforeach
                        </div>
					</div>
				</div>				
			</div>
		</div>
		<div class="form-actions util-btn-margin-bottom-5">
			<div class="row">
				<div class="col-md-offset-3 col-md-9">
					<button type="submit" class="btn btn-primary" name="save_only">
						<i class="fa fa-save"></i> Lưu thay đổi
					</button>

					@if(! isset($role_id))
						<button type="submit" class="btn btn-primary" name="save_and_new">
							<i class="fa fa-save"></i> Lưu và tiếp tục thêm
						</button>
					@else
						<button type="submit" class="btn btn-primary" name="save_and_out">
							<i class="fa fa-save"></i> Lưu và thoát
						</button>
					@endif
				</div>
			</div>
		</div>
	</form>
@endsection

@push('css')
	<link href="{{ url('assets/admin/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ url('assets/admin/global/plugins/icheck/skins/all.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('js_footer')
	<script type="text/javascript" src="{{ url('assets/admin/global/plugins/jquery-form/jquery.form.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/admin/global/plugins/bootstrap-toastr/toastr.min.js') }}"></script>
	<script src="{{ url('assets/admin/global/plugins/icheck/icheck.min.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
	$(function(){
		var handleSlectRoleType = function () {
			return function() {
				var roleType = $('*[name="role[type]"]:selected').val();
				console.log(roleType);
			}
		}
		$('*[name="role[type]"]').change(function(){
			var roleType = $(this).val();
			switch(roleType) {
				case '*': case '0':
					$('.permission-list').hide();
				break;
				case 'option':
					$('.permission-list').show();
				break;
			}
		});
	});
	</script>
@endpush
