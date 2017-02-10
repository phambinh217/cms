@extends('Admin::layouts.default',[
	'active_admin_menu' 	=> ['setting', 'setting.check-version'],
	'breadcrumbs' 			=> [
		'title'	=> ['Cài đặt', 'Kiểm tra phiên bản'],
		'url'	=> [
			route('admin.setting.general')
		],
	],
])

@section('page_title', 'Kiểm tra phiên bản')

@section('content')

@endsection

@push('css')

@endpush

@push('js_footer')

@endpush
