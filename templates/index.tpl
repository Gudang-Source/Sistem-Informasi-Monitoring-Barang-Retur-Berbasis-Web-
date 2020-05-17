<!doctype html>
<head>

	<!-- General Metas -->
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	<!-- Force Latest IE rendering engine -->
	<title>Login Form PT. LOTTE MART CABANG MAKASSAR</title>
	<meta name="description" content="This is inventory application system ">
	<meta name="author" content="PT. Lotte Mart Indonesia Cabang Makassar">
	
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
	
	<!-- Stylesheets -->
	<link rel="stylesheet" href="design/css/base.css">
	<link rel="stylesheet" href="design/css/skeleton.css">
	<link rel="stylesheet" href="design/css/layout.css">
	
</head>
<body>

	<!-- Primary Page Layout -->
	
	<div class="alert-danger-login">{$msg}</div>
	<div class="container">
		
		<div class="form-bg">
			<form method="POST" action="index.php?module=login&act=submit">
				<h2 >LOGIN PT. LOTTE MART CABANG MAKASSAR</h2>
				<p><input type="text" name="username" placeholder="username" required></p>
				<p><input type="password" name="password"  placeholder="password" required></p>
				<button type="submit"></button>
			<form>
		</div>
		
		<br>
		<p class="forgot" style="color:black;    text-shadow:-2px 0px 2px white;" >
			
		
			Copyright &copy; PT. LOTTE MART INDONESIA CAB. MAKASSAR <br>
			Mall Panakukang, Jl. Boulevard Raya No.1<br>
			Makassar, Sulawesi Selatan, Indonesia
		
		</p>


	</div><!-- container -->
	
<!-- End Document -->
</body>
</html>