<?php
    include "adminConfig.php";

    if(isset($_POST['giris_submit'])){
		$uname = mysqli_real_escape_string($con,$_POST['admin_adi']);
        $password = mysqli_real_escape_string($con,$_POST['sifre']);
		 
		 if ($uname != "" && $password != ""){
			 $sql_query = "select count(*) as cntUser from admins where Admin_Adi='".$uname."' and Sifre='".$password."'";
             $result = mysqli_query($con,$sql_query);
             $row = mysqli_fetch_array($result);

    $count = $row['cntUser'];
	
	if($count > 0){
        $_SESSION['ID'] = $ID;
		$_SESSION['uname'] = $uname;
        header('Location: adminHome.php');
    }else {
      echo "<script>alert('Admin Adı ya da Şifre Yanlış!!!');</script>";
    }

          }

    }
?>

<!DOCTYPE html>
<html lang="tr">
<head>
	<title>Admin Girişi</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="" method="post">
					<span class="login100-form-title">
						Admin Girişi
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Admin Adı Gerekli">
						<input class="input100" type="text" name="admin_adi" placeholder="Admin Adı" autofocus>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Şifre Gerekli">
						<input class="input100" type="password" name="sifre" placeholder="Şifre">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="giris_submit">
							Giriş
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Burayı elleme
						</span>
						<a class="txt2" href="#">
							Kullanıcı Adı / Şifre?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							!!!!!!!!!!!!
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>