@extends('Admin::layouts.default',[
	'active_admin_menu' 	=> ['user', 'user.all'],
	'breadcrumbs' 			=> [
		'title'	=> ['Người dùng', 'Danh sách'],
		'url'	=> [
			admin_url('user'),
			admin_url('user'),
		],
	],
])

@section('page_title', 'Danh sách người dùng')

@section('tool_bar')
	<a href="{{ route('admin.user.create') }}" class="btn btn-primary">
		<i class="fa fa-plus"></i> <span class="hidden-xs">Thêm người dùng mới</span>
	</a>
@endsection

@section('content')
	<div class="table-function-container">
		<div class="portlet light bordered filter">
		    <div class="portlet-title">
		        <div class="caption">
		            <i class="fa fa-filter"></i> Bộ lọc kết quả
		        </div>
		        <div class="tools">
		        	<a href="javascript:;" class="collapse" data-original-title="" title=""></a>
		        </div>
		    </div>
		    <div class="portlet-body form">
		        <form action="#" class="form-horizontal form-bordered form-row-stripped">
		            <div class="form-body">
		                <div class="row">
		                    <div class="col-sm-6 md-pr-0">
		                        <div class="form-group">
		                            <label class="control-label col-md-3">Tìm kiếm</label>
		                            <div class="col-md-9">
		                                @include('User::admin.components.form-find-user', [
		                                	'name' 		=> 'id',
		                                	'selected' 	=> isset($filter['id']) ? $filter['id'] : NULL,
		                                ])
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label class="control-label col-md-3">Quyền quản trị</label>
		                            <div class="col-md-9">
		                                @include('User::admin.components.form-select-role', [
		                                	'roles'		=> Phambinh\Cms\User\Models\Role::get(),
		                                	'name' 		=> 'role_id',
		                                	'selected' 	=> isset($filter['role_id']) ? $filter['role_id'] : NULL,
		                                ])
		                            </div>
		                        </div>
		                    </div>
		                    <div class="col-sm-6 md-pl-0">
		                        <div class="form-group">
		                            <label class="control-label col-md-3">Trạng thái</label>
		                            <div class="col-md-9">
		                                @include('User::admin.components.form-select-status', [
		                                	'status'	=> \Phambinh\Cms\User\Models\User::getStatusAble(),
		                                	'name' 		=> 'status',
		                                	'selected' 	=> isset($filter['status']) ? $filter['status'] : NULL,
		                                ])
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            <div class="form-actions util-btn-margin-bottom-5">
		                <div class="row">
		                    <div class="col-md-12 text-right">
		                        <button type="submit" class="btn btn-primary full-width-xs">
		                            <i class="fa fa-filter"></i> Lọc</button>
		                        <a href="{{ admin_url('user') }}" class="btn btn-gray full-width-xs">
		                            <i class="fa fa-times"></i> Hủy
		                        </a>
		                    </div>
		                </div>
		            </div>
		        </form>
		    </div>
		</div>
		<div>
			<div class="note note-success">
	            <p><i class="fa fa-info"></i> Tổng số {{ $users->total() }} kết quả</p>
	        </div>
			<div class="row table-above">
			    <div class="col-sm-6">
			    	<div class="form-inline mb-10 form-function">
				    	@include('Admin::admin.components.form-apply-action', [
				    		'actions' => [
				    			['action' => '', 'name' => ''],
				    			['action' => '', 'name' => ''],
				    			['action' => '', 'name' => ''],
				    		],
				    	])
				    </div>
			    </div>
			    <div class="col-sm-6 text-right table-page">
			    	{!! $users->setPath('user')->appends($filter)->render() !!}
			    </div>
		    </div>
		    <div class="table-responsive main">
				<table class="master-table table table-striped table-hover table-checkable order-column pb-users">
					<thead>
						<tr>
							<th width="50" class="table-checkbox text-center">
								<div class="checker">
									<input type="checkbox" class="icheck check-all">
								</div>
							</th>
							<th class="text-center hidden-xs">
								{!! \Phambinh\Cms\User\Models\User::linkSort('ID', 'id') !!}
							</th>
							<th>
								{!! \Phambinh\Cms\User\Models\User::linkSort('Họ và tên', 'first_name') !!}
							</th>
							<th class="hidden-xs">
								{!! \Phambinh\Cms\User\Models\User::linkSort('Ngày đăng ký', 'created_at') !!}
							</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $user_item)
							<tr class="pb-user-item hover-display-container">
								<td width="50" class="table-checkbox text-center">
									<div class="checker">
										<input type="checkbox" class="icheck" value="{{ $user_item->id }}">
									</div>
								</td>
								<td class="text-center hidden-xs"><strong>{{ $user_item->id }}</strong></td>
			    				<td>
			    					<div class="media">
						                <div class="pull-left">
						                    <img class="img-circle" src="{{ thumbnail_url($user_item->avatarOrDefault(), ['width' => '70', 'height' => '70']) }}" alt="" style="max-width: 70px" />
						                </div>

						                <div class="media-body">
						                    <ul class="info unstyle-list">
						                        <li class="name">
						                        	<a href="{{ route('admin.user.show', ['id' => $user_item->id]) }}"><strong>{{ $user_item->full_name }}</strong></a>
						                        	<span class="label label-sm label-info">
							                        	{{ $user_item->role_name }}
				                                        <i class="fa fa-share"></i>
				                                    </span>
					                        		<span class="hover-display pl-15 hidden-xs">
														<a href="#" remote-modal data-name="#popup-show-user" data-url="{{ route('admin.user.popup-show', ['id' => $user_item->id]) }}" class="text-sm"><i>Xem nhanh |</i></a>
														<a href="" class="text-sm"><i>Gửi tin nhắn</i></a>
													</span>
						                        </li>
						                        <li class="hidden-xs">NS: {{ $user_item->birth or 'Trống' }}</li>
						                        <li class="hidden-xs">SĐT: {{ $user_item->phone or 'Trống' }}</li>
						                        <li class="hidden-xs">Email: {{ $user_item->email or 'Trống' }}</li>
						                    </ul>
						                </div>
						            </div>
			    				</td>
			    				<td style="min-width: 200px" class="hidden-xs">{{ text_time_difference($user_item->created_at) }}</td>
			    				<td>
			    					<div class="btn-group pull-right" table-function>
			                            <a href="" class="btn btn-circle btn-xs grey-salsa btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
											<span class="hidden-xs">
				                            	Chức năng
				                                <span class="fa fa-angle-down"> </span>
			                                </span>
			                                <span class="visible-xs">
			                                	<span class="fa fa-cog"> </span>
			                                </span>
			                            </a>
			                            <ul class="dropdown-menu pull-right">
			                                <li><a href="{{ route('admin.user.show', ['id' => $user_item->id]) }}"><i class="fa fa-eye"></i> Xem</a></li>
			                                <li role="presentation" class="divider"> </li>
			                                <li><a href="{{ route('admin.user.edit', ['id' => $user_item->id]) }}"><i class="fa fa-pencil"></i> Sửa</a></li>
			                            	@if($user_item->isEnable() && ! $user_item->isSelf($user_item->id))
			                            		<li><a data-function="disable" data-method="put" href="{{ route('admin.user.disable', ['id' => $user_item->id]) }}"><i class="fa fa-recycle"></i> Xóa tạm</a></li>
			                            	@endif

			                            	@if($user_item->isDisable())
			                            		<li><a data-function="enable" data-method="put" href="{{ route('admin.user.enable', ['id' => $user_item->id]) }}"><i class="fa fa-recycle"></i> Khôi phục</a></li>
			                            		<li role="presentation" class="divider"></li>
			                            		<li><a data-function="destroy" data-method="delete" href="{{ route('admin.user.destroy', ['id' => $user_item->id]) }}"><i class="fa fa-times"></i> Xóa</a></li>
			                            	@endif
			                            </ul>
			                        </div>
			    				</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
	    </div>
    </div>
@endsection

@push('css')
	<link href="{{ url('assets/admin/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ url('assets/admin/global/plugins/icheck/skins/all.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('js_footer')
	<script type="text/javascript" src="{{ url('assets/admin/global/plugins/bootstrap-toastr/toastr.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/admin/global/plugins/icheck/icheck.min.js')}} "></script>
@endpush