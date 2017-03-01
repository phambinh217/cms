@extends('Cms::layouts.default',[
	'active_admin_menu' 	=> ['user', 'user.role'],
	'breadcrumbs' 			=> [
		'title'	=> ['Người dùng', 'Vai trò'],
		'url'	=> [
			admin_url('user'),
		],
	],
])

@section('page_title', 'Vai trò người dùng')
@can('admin.role.create')
	@section('tool_bar')
		<a href="{{ route('admin.role.create') }}" class="btn btn-primary">
			<i class="fa fa-plus"></i> <span class="hidden-xs">Thêm vai trò mới</span>
		</a>
	@endsection
@endcan
@section('content')
	<div class="table-function-container">
		<div class="note note-success">
            <p><i class="fa fa-info"></i> Tổng số {{ $roles->total() }} kết quả</p>
        </div>
		<div class="row table-above">
		    <div class="col-sm-6">
		    	<div class="form-inline mb-10">
			    	@include('Cms::components.form-apply-action', [
			    		'actions' => [
			    			['action' => '', 'name' => 'Xóa tạm'],
			    		],
			    	])
			    </div>
		    </div>
		    <div class="col-sm-6 text-right">
		    	{!! $roles->setPath('role')->appends($filter)->render() !!}
		    </div>
	    </div>
	    <div class="table-responsive main">
			<table class="master-table table table-striped table-hover table-checkable order-column pb-roles">
				<thead>
					<tr>
						<th width="50" class="table-checkbox text-center">
							<div class="checker">
								<input type="checkbox" class="icheck check-all">
							</div>
						</th>
						<th class="text-center hidden-xs">
							{!! \Phambinh\Cms\Role::linkSort('ID', 'id') !!}
						</th>
						<th>
							{!! \Phambinh\Cms\Role::linkSort('Tên vai trò', 'name') !!}
						</th>
						<th class="text-center hidden-xs">
							{!! \Phambinh\Cms\Role::linkSort('Số tài khoản', 'total_user') !!}
						</th>
						<th class="hidden-xs">
							{!! \Phambinh\Cms\Role::linkSort('Ngày tạo', 'created_at') !!}
						</th>
						<th></th>
					</tr>
				</thead>
				<tbody class="pb-roles">
					@foreach($roles as $role_item)
						<tr class="pb-role-item hover-display-container">
							<td width="50" class="table-checkbox text-center">
								<div class="checker">
									<input type="checkbox" class="icheck" value="{{ $role_item->id }}">
								</div>
							</td>
							<td class="text-center hidden-xs"><strong>{{ $role_item->id }}</strong></td>
		    				<td>
		    					@can('admin.role.edit', $role_item)
			    					<a href="{{ route('admin.role.edit', ['id' => $role_item->id]) }}">
			    						<strong>{{ $role_item->name }}</strong>
			    					</a>
		    					@endcan
		    					@cannot('admin.role.edit', $role_item)
		    						<strong>{{ $role_item->name }}</strong>
		    					@endcannot
		    				</td>
		    				<td class="text-center hidden-xs">
		    					<strong>
		    						{{ $role_item->total_user }}
		    					</strong>
		    				</td>
		    				<td class="hidden-xs" style="min-width: 200px">{{ text_time_difference($role_item->created_at) }}</td>
		    				<td table-action>
								<div class="btn-group" table-function>
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
		                            	@can('admin.role.edit', $role_item)
			                                <li><a href="{{ route('admin.role.edit', ['id' => $role_item->id]) }}"><i class="fa fa-pencil"></i> Sửa</a></li>
			                                <li role="presentation" class="divider"> </li>
		                                @endcan
		                                @can('admin.role.destroy', $role_item)
		                            		<li><a data-function="destroy" data-method="delete" href="{{ route('admin.role.destroy', ['id' => $role_item->id]) }}"><i class="fa fa-times"></i> Xóa</a></li>
		                            	@endcan
		                            </ul>
		                        </div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
    </div>
@endsection

@push('css')
	<link href="{{ asset_url('admin', 'global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset_url('admin', 'global/plugins/icheck/skins/all.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('js_footer')
	<script type="text/javascript" src="{{ asset_url('admin', 'global/plugins/bootstrap-toastr/toastr.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset_url('admin', 'global/plugins/icheck/icheck.min.js')}} "></script>
@endpush