**Giới thiệu**
 Contact là module cho phép gửi một thông điệp từ người dùng đến một địa chỉ email mà do quản trị viên cài đặt trước.
 Để có thể sử dụng module contact. Bạn cần thực hiện chức năng đăng ký một liên hệ mới

# Đăng ký
\Contact::register('alias-contact', [
	'mailTo'	=>	'' // Địa chỉ email nhận thông tin liên hệ,
	'name'		=>	'', // Tên của người nhận
	'validate'	=>	[], // Các trường thông tin, sử dụng cú pháp validate của laravel [https://laravel.com/docs/5.3/validation](Đọc thêm thông tin),
	'template'	=>	'', // Template đến file view của chức năng gửi mail trong laravel,
	'message'	=>	'', // Nội dung thông báo khi được gửi thành công
	'redirect'	=>	'', // Chuyển hướng trang sau khi gửi thành công, nhận 2 loại giá trị 'back' (trở về trang trước), hoặc một 'url cụ thể'
]);

# Action
Thông tin của form liên hệ sẽ được gửi về route('contact/{alias-contact}') với method POST