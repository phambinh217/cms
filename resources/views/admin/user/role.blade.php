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

@section('content')

@endsection

@push('css')

@endpush

@push('js_footer')

@endpush
