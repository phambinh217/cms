<div class="dashboard-stat {{ $color or 'blue' }}">
    <div class="visual">
        <i class="fa fa-users"></i>
    </div>
    <div class="details">
        <div class="number">
            <span data-counter="counterup" data-value="{{ $total }}">{{ $total }}</span>
        </div>
        <div class="desc"> Tổng thành viên </div>
    </div>
    <a class="more" href="javascript:;"> View more
        <i class="m-icon-swapright m-icon-white"></i>
    </a>
</div>