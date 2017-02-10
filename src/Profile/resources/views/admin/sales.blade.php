@extends('Admin::layouts.default', [
    'active_admin_menu' => ['profile', 'profile.sales'],
    'breadcrumbs'   =>  [
        'title' =>  ['Cá nhân', 'Doanh số'],
        'url'   =>  [
            admin_url('profile'),
            admin_url('profile/change-password'),
        ],
    ],
])

@section('page_title', 'Doanh thu')

@section('content')
	<div class="row widget-row">
        <div class="col-md-4">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading">Giới thiệu trong tháng</h4>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-green icon-bulb"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle">Học viên</span>
                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="7,644">7,644</span>
                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->
        </div>
        <div class="col-md-4">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading">Tổng học viên</h4>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-purple icon-screen-desktop"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle">Học viên</span>
                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="815">815</span>
                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->
        </div>
    </div>
    <div class="row">
    	<div class="col-md-6">
	        <div class="portlet light portlet-fit bordered">
	            <div class="portlet-title">
	                <div class="caption">
	                    <i class=" icon-layers font-red"></i>
	                    <span class="caption-subject font-red bold uppercase">Nhóm học viên của bạn</span>
	                </div>
	                <div class="actions">
	                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
	                        <i class="icon-cloud-upload"></i>
	                    </a>
	                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
	                        <i class="icon-wrench"></i>
	                    </a>
	                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
	                        <i class="icon-trash"></i>
	                    </a>
	                </div>
	            </div>
	            <div class="portlet-body">
	                <p>TỈ lệ giữa các học viên mà bạn giới thiệu được từ trước đến giờ</p>
	                <div id="pie_chart_9" class="chart"> </div>
	            </div>
	        </div>
	    </div>
	    <div class="col-md-6">
	        <div class="portlet light portlet-fit bordered">
	            <div class="portlet-title">
	                <div class="caption">
	                    <i class=" icon-layers font-red"></i>
	                    <span class="caption-subject font-red bold uppercase">Học viên mới nhất</span>
	                </div>
	                <div class="actions">
	                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
	                        <i class="icon-cloud-upload"></i>
	                    </a>
	                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
	                        <i class="icon-wrench"></i>
	                    </a>
	                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
	                        <i class="icon-trash"></i>
	                    </a>
	                </div>
	            </div>
	            <div class="portlet-body">
	               
	            </div>
	        </div>
	    </div>
    </div>
@endsection

@push('css')

@endpush

@push('js_footer')
	<!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ url('assets/admin/global/plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/admin/global/plugins/flot/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/admin/global/plugins/flot/jquery.flot.categories.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/admin/global/plugins/flot/jquery.flot.pie.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/admin/global/plugins/flot/jquery.flot.stack.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/admin/global/plugins/flot/jquery.flot.crosshair.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/admin/global/plugins/flot/jquery.flot.axislabels.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{ url('assets/pages/scripts/charts-flotcharts.min.js') }}" type="text/javascript"></script>
@endpush
