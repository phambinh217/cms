@extends('Admin::layouts.default',[
	'active_admin_menu' 	=> ['module-control', 'module-control.theme'],
	'breadcrumbs' 			=> [
		'title'	=> ['Quản lí module', 'module chủ đề'],
		'url'	=> [
			route('admin.module-control.module.index'),
		],
	],
])

@section('page_title', 'Quản lí module chủ đề')

@section('content')
	<div class="table-function-container">
		<div class="row table-above">
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
	    <div class="table-responsive main">
			<table class="master-table table table-hover table-checkable order-column pb-themes">
				<thead>
					<tr>
						<th width="50" class="table-checkbox text-center">
								<div class="checker">
									<input type="checkbox" class="icheck check-all">
								</div>
							</th>
						<th class="text-center">
							theme
						</th>
						<th>
							Mô tả
						</th>
						<th></th>
					</tr>
				</thead>
				<tbody class="pb-themes">
					@foreach($themes as $theme_item)
						<tr class="pb-administrator-item hover-display-container">
							<th width="50" class="table-checkbox text-center">
								<div class="checker">
									<span>
										<input type="checkbox" class="group-checkable">
									</span>
								</div>
							</th>
		    				<td>
		    					<div class="media">
					                <div class="pull-left">
					                    <img class="" src="{{ $theme_item->icon }}" alt="" style="max-width: 70px" />
					                </div>

					                <div class="media-body">
					                    <ul class="info unstyle-list">
					                        <li class="name">
					                        	<a href=""><strong>{{ title_case($theme_item->name) }}</strong></a>
					                        </li>
					                        <li>Tác giả: {{ $theme_item->author or 'Trống' }}</li>
					                        <li>Phiên bản: {{ $theme_item->version or 'Trống' }}</li>
					                    </ul>
					                </div>
					            </div>
		    				</td>
		    				<td style="min-width: 200px">{{ $theme_item->description }}</td>
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
		                                <span class="fa fa-angle-down"> </span>
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