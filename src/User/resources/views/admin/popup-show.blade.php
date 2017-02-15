<div class="modal fade" id="popup-show-user">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">{{ $user->full_name }}</h4>
			</div>
			<div class="modal-body">
				<div class="media">
                    <a class="pull-left" href="javascript:;">
                        <img class="media-object" src="{{ $user->avatarOrDefault() }}" style="width: 100px; height: 100px;"> </a>
                    <div class="media-body">
                        <h4 class="media-heading">
                        	{{ $user->full_name }}
                        	<span class="label label-sm label-info">{{ $user->role()->select('roles.name')->first()->name }}</span>
                        </h4>
                        <ul>
                        	<li>Ngày sinh: {{ changeFormatDate($user->birth, DTF_DB, DF_DB) }}</li>
                        	<li>SĐT: {{ $user->phone }}</li>
                        	<li>Địa chỉ: {{ $user->address }}</li>
                        </ul>
                    </div>
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
			</div>
		</div>
	</div>
</div>