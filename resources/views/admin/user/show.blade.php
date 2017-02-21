@extends('Cms::layouts.default',[
	'active_admin_menu' 	=> ['user', 'user.all'],
	'breadcrumbs' 			=> [
		'title'	=> ['Người dùng', 'Danh sách', 'Xem'],
		'url'	=> [
			admin_url('user'),
			admin_url('user'),
		],
	],
])

@section('page_title', 'Xem chi tiết')

@section('page_sub_title', $user->full_name)

@section('tool_bar')
	<a href="{{ route('admin.user.edit', ['id' => $user->id]) }}" class="btn btn-primary">
		<i class="fa fa-pencil"></i> <span class="hidden-xs">Chỉnh sửa</span>
	</a>
@endsection

@section('content')

@endsection

@push('css')

@endpush

@push('js_footer')

@endpush
