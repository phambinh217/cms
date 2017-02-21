<select name="{!! $name !!}" class="form-control">
	<option value="">Bằng</option>
	<option value="less_equal:">Nhỏ hơn hoặc bằng</option>
	<option value="greater_equal:">Lớn hơn hoặc bằng</option>
	<option value="less:">Nhỏ hơn</option>
	<option value="greater:">Lớn hơn</option>
</select>

@push('js_footer')
	<script type="text/javascript">
		$(function(){
			$('select[name="{!! $name !!}"]').on('change', function(){
				var compare = $(this).val();
				$('{!! $target !!}').attr('value', compare);
			});
		});
	</script>
@endpush