<div class="top-menu">
	<ul class="nav navbar-nav pull-right">
		<li class="separator hide"> </li>

		<!-- BEGIN USER LOGIN DROPDOWN -->
		<li class="dropdown dropdown-user">
			<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<span class="username username-hide-on-mobile"> {{ \Auth::user()->name }} </span>
				<img alt="" class="img-circle" src="{{ thumbnail_url(\Auth::user()->avatarOrDefault(), ['width' => '50', 'height' => '50']) }}" />
			</a>
			<ul class="dropdown-menu dropdown-menu-default">
				<li>
					<a href="{{ admin_url('profile') }}">
						<i class="icon-user"></i> Trang cá nhân
					</a>
				</li>
				<li>
					<a href="{{ admin_url('mail/inbox') }}">
						<i class="icon-envelope-open"></i> Tin nhắn
					</a>
				</li>
				<li class="divider"> </li>
				<li>
                    <a href="{{ url('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="icon-key"></i> Đăng xuất
                    </a>

                    <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </li>
			</ul>
		</li>
		<!-- END USER LOGIN DROPDOWN -->

	</ul>
</div>
