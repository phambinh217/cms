<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	@php \Metatag::render(); @endphp
	<link rel="stylesheet" href="" />
	@yield('css')
</head>
<body>
	@yield('content')
	@yield('js_footer')
</body>
</html>