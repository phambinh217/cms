@extends('Admin::layouts.default',[
	'active_admin_menu' 	=> ['module-control', 'module-control.module'],
	'breadcrumbs' 			=> [
		'title'	=> ['Quản lí module', 'Module chức năng'],
		'url'	=> [
			route('admin.module-control.module.index'),
		],
	],
])

@section('page_title', 'Module chức năng')

@section('content')
	<div table-function-container>
		<div class="row">
		    <div class="col-sm-6">
		    	<div class="form-inline mb-10">
			    	@include('Admin::admin.components.form-apply-action', [
				    		'actions' => [
				    			['action' => '', 'name' => ''],
				    			['action' => '', 'name' => ''],
				    			['action' => '', 'name' => ''],
				    		],
				    	])
			    </div>
		    </div>
		    <div class="col-sm-6 text-right"></div>
	    </div>
		<table class="master-table table table-hover table-checkable order-column pb-modules">
			<thead>
				<tr>
					<th width="50" class="table-checkbox text-center">
						<div class="checker">
									<input type="checkbox" class="icheck check-all">
								</div>
					</th>
					<th class="text-center">
						Module
					</th>
					<th>
						Mô tả
					</th>
					<th></th>
				</tr>
			</thead>
			<tbody class="pb-modules">
				@foreach($modules as $module_item)
					<tr class="pb-administrator-item hover-display-container">
						<th width="50" class="table-checkbox text-center">
								<div class="checker">
									<input type="checkbox" class="icheck check-all">
								</div>
							</th>
	    				<td>
	    					<div class="media">
				                <div class="pull-left">
				                    <img class="" src="{{ $module_item->icon }}" alt="" style="max-width: 70px" />
				                </div>

				                <div class="media-body">
				                    <ul class="info unstyle-list">
				                        <li class="name">
				                        	<a href=""><strong>{{ title_case($module_item->name) }}</strong></a>
				                        </li>
				                        <li>Tác giả: {{ $module_item->author or 'Trống' }}</li>
				                        <li>Phiên bản: {{ $module_item->version or 'Trống' }}</li>
				                    </ul>
				                </div>
				            </div>
	    				</td>
	    				<td style="min-width: 200px">{{ $module_item->description }}</td>
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
	                                <li><a href=""><i class="fa fa-eye"></i> Xem</a></li>
	                                <li role="presentation" class="divider"> </li>
	                            </ul>
	                        </div>
	    				</td>
					</tr>
				@endforeach
			</tbody>
		</table>
    </div>
@endsection

@push('css')
	
@endpush

@push('js_footer')

@endpush
