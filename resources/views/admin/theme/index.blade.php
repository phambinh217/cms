@extends('Cms::layouts.default',[
	'active_admin_menu' 	=> ['module-control', 'module-control.theme'],
	'breadcrumbs' 			=> [
		'title'	=> [trans('module.manage-module'), trans('module.module-theme')],
		'url'	=> [
			route('admin.module-control.module.index'),
		],
	],
])

@section('page_title', trans('module.module-theme'))

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
			@foreach($themes as $theme_item)
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
			                        	<a href=""><strong>{{ title_case($theme_item->name) }}</strong></a>f
			                        </li>
			                        <li>@lang('module.author'): {{ $theme_item->authors[0]['name'] or trans('cms.empty') }}</li>
			                        <li>@lang('module.version'): {{ $theme_item->version or trans('cms.empty') }}</li>
			                    </ul>
			                </div>
			            </div>
    				</td>
    				<td style="min-width: 200px">{{ $theme_item->description or '' }}</td>
				</tr>
			@endforeach
		@endslot
	@endcomponent
@endsection
