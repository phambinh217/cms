@extends('Cms::layouts.default',[
	'active_admin_menu' 	=> ['module-control', 'module-control.module'],
	'breadcrumbs' 			=> [
		'title'	=> [trans('module.manage-module'), trans('module.module-function')],
		'url'	=> [
			route('admin.module-control.module.index'),
		],
	],
])

@section('page_title', trans('module.module-function'))

@section('content')
	@component('Cms::components.table-function')
		@slot('heading')
			<th width="50" class="table-checkbox text-center">
				{!! Form::icheck(null, null, ['class' => 'check-all']) !!}
			</th>
			<th class="text-center">
				@lang('module.name')
			</th>
			<th>
				@lang('module.description')
			</th>
		@endslot

		@slot('data')
			@foreach($modules as $module_item)
				<tr class="pb-administrator-item hover-display-container">
					<td width="50" class="table-checkbox text-center">
						{!! Form::icheck(null, null) !!}
					</td>
    				<td>
    					<div class="media">
			                <div class="pull-left">
			                    
			                </div>

			                <div class="media-body">
			                    <ul class="info unstyle-list">
			                        <li class="name">
			                        	<a href=""><strong>{{ title_case($module_item->name) }}</strong></a>
			                        </li>
			                        <li>@lang('module.author'): {{ $module_item->authors[0]['name'] or trans('cms.empty') }}</li>
			                        <li>@lang('module.version'): {{ $module_item->version or trans('cms.empty') }}</li>
			                    </ul>
			                </div>
			            </div>
    				</td>
    				<td style="min-width: 200px">{{ $module_item->description or '' }}</td>
				</tr>
			@endforeach
		@endslot
	@endcomponent
@endsection
