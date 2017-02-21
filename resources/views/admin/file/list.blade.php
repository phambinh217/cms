@extends('Cms::layouts.default',[
	'active_admin_menu' 	=> ['file'],
	'breadcrumbs' 			=> [
		'title'	=> [
			'Quản lí file',
		],
		'url'	=> [],
	],
])

@section('page_title', 'Quản lí file')

@section('content')
	<div class="embed-responsive embed-responsive-16by9">
		<iframe class="embed-responsive-item" src="{{ admin_url('file/elfinder/stand-alone') }}"></iframe>
	</div>
@endsection

@push('css')

@endpush

@push('js_footer')

@endpush
