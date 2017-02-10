@extends('Admin::layouts.default',[
	'active_admin_menu' 	=> ['mail', 'mail.inbox'],
	'breadcrumbs' 			=> [
		'title'	=> ['Tin nhắn', 'Hộp thư đến', 'Đọc'],
		'url'	=> [
			admin_url('mail'),
			admin_url('mail/inbox'),
		],
	],
])

@section('page_title', 'Xem tin nhắn')

@section('tool_bar')
	<a href="{{ route('admin.mail.create') }}" class="btn btn-primary">
        <i class="fa fa-plus"></i> <span class="hidden-xs">Soạn tin mới</span>
    </a>
@endsection

@section('content')
	<?php  $sender = $mail->sender; ?>
	<div class="inbox">
	    <div class="inbox-body">
	        <div class="inbox-content"><div class="inbox-header inbox-view-header">
	            <h1 class="pull-left">{{ $mail->subject }}
	                <a href="{{ route('admin.mail.outbox') }}"> Thư đi </a>
	            </h1>
	            <div class="pull-right">
	                <a href="javascript:;" class="btn btn-icon-only dark btn-outline">
	                    <i class="fa fa-print"></i>
	                </a>
	            </div>
	        </div>
	        <div class="inbox-view-info">
	            <div class="row">
	                <div class="col-md-7">
	                    <img src="{{ thumbnail_url($sender->avatarOrDefault() , ['width' => '45', 'height' => '45']) }}" class="inbox-author">
	                    <span class="sbold">{{ $sender->full_name }} </span>
	                    <span>&lt;{{ $sender->email }}&gt; </span> đến
	                    <span class="sbold"> tôi </span> vào lúc {{ text_time_difference($mail->created_at) }}
	                </div>
	                <div class="col-md-5 inbox-info-btn">
	                    {{-- <div class="btn-group">
	                        <a class="btn btn-primary" remote-modal data-name="#popup-forward" data-url="{{ route('admin.mail.popup-forward') }}" href="#">
	                            <i class="fa fa-reply"></i> Chuyển tiếp
	                        </a>
	                    </div> --}}
	                </div>
	            </div>
	            <div class="inbox-view">
	            	{{ $mail->content }}
	            </div>
	        </div>
	    </div>
	</div>
@endsection

@push('css')
	<link href="{{ url('assets/admin/css/inbox.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ url('assets/admin/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@push('js_footer')
    <script type="text/javascript" src="{{ url('assets/admin/global/plugins/jquery-form/jquery.form.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/admin/global/plugins/bootstrap-toastr/toastr.min.js') }}"></script>
@endpush