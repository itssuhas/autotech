<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="https://pms-scpwd.in/favicon.ico" type="image/x-icon"> <!-- Favicon-->
    <title>Welcome Auto Tech</title>
    <link rel="stylesheet" href="https://pms-scpwd.in/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://pms-scpwd.in/assets/css/index-util.css">
	<link rel="stylesheet" type="text/css" href="css/index-main.css">
    <link rel="stylesheet" href="https://pms-scpwd.in/assets/css/main.css">
</head>
<body>
    <div class="limiter">
	<div class="container-login100"> 
		<div class="wrap-login100">
        <span class="login100-form-title">Auto Technology</span>         
			<div class="login100-form-title">		
                <div class="container-login100-form-btn">
                    <button class="btn-info btn-lg" onclick="location.href='{{route('login')}}'">
                        Admin Login
                    </button>
                </div>
                <div class="container-login100-form-btn" onclick="location.href='{{route('login')}}'">
                    <button class="btn-info btn-lg">
                        Inspectors Login
                    </button>
                </div>
                <div class="container-login100-form-btn" onclick="location.href='{{route('login')}}'">
                    <button class="btn-info btn-lg">
                     Approvers Login
                    </button>
                </div>
			</div>
			<div class="login100-form-title">
				<p>&copy; All Rights Reserved | Developed &amp; Maintained by <a href="#">Suhas Salunke</a></p>
			</div>
		</div>
	</div>
</div>
    <script src="https://pms-scpwd.in/assets/plugins/jquery/jquery-v3.2.1.min.js"></script>
    <script src="https://pms-scpwd.in/assets/bundles/libscripts.bundle.js"></script>    
    <script src="https://pms-scpwd.in/assets/js/tilt.jquery.min.js"></script>
        <script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
</body>
</html>