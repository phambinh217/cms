@extends('Cms::layouts.default',[
    'active_admin_menu' => ['dashboard', 'overview'],
    'breadcrumbs'       =>  [
        'title' => ['Tổng quan'],
        'url'   => [
            route('admin.dashboard'),
        ],
    ],
])

@section('page_title', 'Bảng quản trị')
@section('page_sub_title', 'Tổng quan và thống kê')

@section('content')
    <div class="row">
        <div class="col-sm-3">
            @widget(\Phambinh\Cms\Widgets\UserBoxData::class)
        </div>
    </div>
    Chào {{ \Auth::user()->full_name }}
@endsection

@push('css')
	
@endpush

@push('js_footer')
	
@endpush