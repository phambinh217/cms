@extends('Admin::layouts.default',[
	'active_admin_menu' 	=> ['setting', 'setting.appearance', 'setting.appearance.menu'],
	'breadcrumbs' 			=> [
		'title'	=> ['Cài đặt', 'Giao diện', 'Menu'],
		'url'	=> [
			route('admin.setting.appearance.menu'),
			route('admin.setting.appearance.menu'),
		],
	],
])

@section('page_title', 'Cài đặt menu')

@section('content')
	<div class="tabbable-line">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#menus" data-toggle="tab"> Menus </a>
			</li>
			<li>
				<a href="#new-menu" data-toggle="tab"> Thêm mới </a>
			</li>
			<li>
				<a href="#set-menu" data-toggle="tab"> Đặt vị trí </a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane fade active in" id="menus">
				<div id="app-menu">
					<div class="row" v-if="all_menu.length != 0">
						<div class="col-sm-4">
							<form class="form-horizontal ajax-form" method="POST" action="">
								<div class="form-body">
									<div class="form-group">
									<label class="control-lalel col-sm-4 pull-left">
											Chọn menu
										</label>
										<div class="col-sm-8">
											<select class="form-control" @change="changeMenu($event)">
												<option v-for="menu_item in all_menu" :value="menu_item.id">@{{ menu_item.name }}</option>
											</select>
										</div>
									</div>
								</div>
								<div class="mb-10">
									<div class="text-right">
										<span data-toggle="collapse" data-target="#edit-menu">Chỉnh sửa</span>
									</div>
									<div id="edit-menu" class="collapse">
										<div class="form-body">
											<div class="form-group">
												<label class="control-lalel col-sm-4 pull-left">
													Tên menu
												</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" :value="menu.name">
												</div>
											</div>
										
											<div class="form-group">
												<label class="control-lalel col-sm-4 pull-left">
													Slug
												</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" :value="menu.slug">
												</div>
											</div>
										</div>
										<div class="form-actions util-btn-margin-bottom-5">
											<button class="btn btn-primary full-width-xs">
												<i class="fa fa-save"></i> Cập nhật menu
											</button>
										</div>
									</div>
								</div>
							</form>
							<div class="portlet light bordered form-fit">
								<div class="portlet-title with-tab">
									<div class="tab-default">
										<ul class="nav nav-tabs">
											@foreach(\Menu::all() as $menu_item)
												<li class="{{ $loop->index == 0 ? 'active' : null }}">
													<a href="#{{ str_slug($menu_item['name']) }}" data-toggle="tab" aria-expanded="true"> {{ $menu_item['name'] }} </a>
												</li>
											@endforeach
										</ul>
									</div>
								</div>
								<div class="portlet-body form">
									<div class="tab-content">
										@foreach(\Menu::all() as $menu_item)
											<div class="tab-pane {{ $loop->index == 0 ? 'active' : null }}" id="{{ str_slug($menu_item['name']) }}">
												<form class="form-horizontal ajax-form" method="POST" :action="'{{ admin_url('setting/appearance/menu') }}/'+menu.id">
													<div class="form-body" style="padding: 15px">
														{{ csrf_field() }}
														<input type="hidden" name="type" value="{{ $menu_item['type'] }}">
														@include('Setting::admin.components.form-checkbox-menu-item', [
															'items' => $menu_item['type']::get(),
															'name' => 'object_id[]',
														])
								                    </div>
								                    <div class="form-actions util-btn-margin-bottom-5" style="padding: 15px">
								                    	<button class="btn btn-primary full-width-xs">
								                    		<i class="fa fa-plus"></i> Thêm
								                    	</button>
								                    </div>
								                </form>
											</div>
										@endforeach
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-8">
							<div class="portlet light bordered">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-list"></i>
										<span class="caption-subject bold uppercase"> Cấu trúc menu </span>
									</div>
								</div>
								<div class="portlet-body">
									<div class="dd" id="nestable_list_1">
										<ol class="dd-list">
											<li class="dd-item" data-id="1">
												<div class="dd-handle"> Item 1 </div>
											</li>
											<li class="dd-item" data-id="2">
												<div class="dd-handle"> Item 2 </div>
												<ol class="dd-list">
													<li class="dd-item" data-id="3">
														<div class="dd-handle"> Item 3 </div>
													</li>
													<li class="dd-item" data-id="4">
														<div class="dd-handle"> Item 4 </div>
													</li>
													<li class="dd-item" data-id="5">
														<div class="dd-handle"> Item 5 </div>
														<ol class="dd-list">
															<li class="dd-item" data-id="6">
																<div class="dd-handle"> Item 6 </div>
															</li>
															<li class="dd-item" data-id="7">
																<div class="dd-handle"> Item 7 </div>
															</li>
															<li class="dd-item" data-id="8">
																<div class="dd-handle"> Item 8 </div>
															</li>
														</ol>
													</li>
													<li class="dd-item" data-id="9">
														<div class="dd-handle"> Item 9 </div>
													</li>
													<li class="dd-item" data-id="10">
														<div class="dd-handle"> Item 10 </div>
													</li>
												</ol>
											</li>
											<li class="dd-item" data-id="11">
												<div class="dd-handle"> Item 11 </div>
											</li>
											<li class="dd-item" data-id="12">
												<div class="dd-handle"> Item 12 </div>
											</li>
										</ol>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="new-menu">
				<form class="form-horizontal ajax-form" method="POST" action="{{ route('admin.setting.appearance.menu.store') }}">
					{{ csrf_field() }}
					<div class="form-body">
						<div class="form-group">
							<label class="control-lalel col-sm-3 pull-left">
								Tên menu
							</label>
							<div class="col-sm-3">
								<input type="text" name="menu[name]" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-lalel col-sm-3 pull-left">
								Slug
							</label>
							<div class="col-sm-3">
								<input type="text" name="menu[slug]" class="form-control" />
								<label class="checkbox-inline">
									<input type="checkbox" value="true" checked="" id="create-slug">
									Từ tên menu
								</label>
							</div>
						</div>
					</div>
					<div class="form-actions util-btn-margin-bottom-5">
						<button class="btn btn-primary full-width-xs">
							<i class="fa fa-save"></i> Thêm
						</button>
					</div>
				</form>
			</div>
			<div class="tab-pane fade" id="set-menu">
				<form class="form-horizontal ajax-form" method="POST" action="">
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<div class="form-body">
						@foreach(\Menu::locationAll() as $location_item)
							<div class="form-group">
								<label class="control-lalel col-sm-3 pull-left">
									{{ $location_item['name'] }}
								</label>
								<div class="col-sm-3">
									@include('Setting::admin.components.form-select-menu', [
										'class' => 'widh-auto',
										'menus' => $menus,
										'name' => 'menuname',
										'selected' => '',
									])
								</div>
							</div>
						@endforeach
					</div>
					<div class="form-actions util-btn-margin-bottom-5">
						<button class="btn btn-primary full-width-xs">
							<i class="fa fa-save"></i> Lưu
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

@push('css')
	<link href="{{ url('assets/admin/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ url('assets/admin/global/plugins/jquery-nestable/jquery.nestable.css')}}" rel="stylesheet" type="text/css" />
@endpush

@push('html_footer')
	<script type="text/x-template" id="menu-item-cpn">
		
	</script>
@endpush

@push('js_footer')
	<script type="text/javascript" src="{{ url('assets/admin/global/plugins/jquery-form/jquery.form.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/admin/global/plugins/bootstrap-toastr/toastr.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/admin/global/plugins/vuejs/js/vue.js') }}"></script>
	<script type="text/javascript">
		$('#create-slug').click(function() {
			if(this.checked) {
				var title = $('input[name="menu[name]"]').val();
				var slug = strSlug(title);
				$('input[name="menu[slug]"]').val(slug);
			}
		});

		$('input[name="menu[name]"]').keyup(function() {
			if ($('#create-slug').is(':checked')) {
				var title = $(this).val();
				var slug = strSlug(title);
				$('input[name="menu[slug]"]').val(slug);	
			}
		});

		var appMenu = new Vue({
			el: '#app-menu',
			data: {
				menu: {!! ! $menus->isEmpty() ? $menus->first()->toJson() : "[]" !!},
				menu_id: {!! ! $menus->isEmpty() ? $menus->first()->id : -1 !!},
				all_menu: {!! ! $menus->isEmpty() ? $menus->toJson() : "[]" !!},
				all_item: {!! ! $menu_items->isEmpty() ? $menu_items->toJson() : "[]" !!},
			},
			methods: {
				changeMenu: function(e) {
					var menu_id = e.target.value;
					this.menu = this.all_menu.filter(function(item){
						if (item.id == menu_id) {
							return item;
						}
					})[0];
					this.menu_id = this.menu.id;
				},
			},
		});
	</script>
@endpush
