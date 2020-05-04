<?php
session_start();
//
//echo $_SESSION['uname'];

$ID = $_SESSION['ID'];

$host = "localhost"; /* Host name */
$username = "root"; /* User */
$password = ""; /* Password */
$dbname = "admindb"; /* Database name */

$conn = mysqli_connect($host, $username, $password, $dbname);
// Check connection
if (!$conn) {
 die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['degistir_btn'])) {
  
  $sifre = mysqli_real_escape_string($conn,$_POST['sifre']);
  $sifre_birDaha = mysqli_real_escape_string($conn,$_POST['sifre_bir_daha']);
  
  if ($sifre === $sifre_birDaha && ($sifre != '' && $sifre_birDaha != '')) {
  
    if ($stmt = $conn->prepare("UPDATE admins SET Sifre=? WHERE ID=?")) {
 
      // Bind the variables to the parameter as strings. 
      $stmt->bind_param("ss", $sifre, $ID);
 
      // Execute the statement.
      $stmt->execute();
 
      // Close the prepared statement.
      $stmt->close();
    
    }

  }
  
  else
  {
   echo "<script>alert('Girdiğiniz Şifreler Birbiriyle Uyuşmuyor!')</script>";
  }

}

?>

<?php

if(isset($_POST['önceki_sayfa_btn'])){
	header('Location: adminHome.php');
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" lang="tr"> 
<head>
<meta charset="utf-8">
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
   <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
   <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type>
<meta name="viewport" content="width=device-width, initial-scale=1">
 
<title>Admin Ayarlar Sayfası</title>

<style>
.form-style-9{
    max-width: 500px;
    background: #FAFAFA;
    padding: 30px;
    margin: 50px auto;
    box-shadow: 1px 1px 25px rgba(0, 0, 0, 0.35);
    border-radius: 10px;
    border: 6px solid #305A72;
}
.form-style-9 ul{
    padding:0;
    margin:0;
    list-style:none;
}
.form-style-9 ul li{
    display: block;
    margin-bottom: 10px;
    min-height: 35px;
}
.form-style-9 ul li  .field-style{
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    padding: 8px;
    outline: none;
    border: 1px solid #B0CFE0;
    -webkit-transition: all 0.30s ease-in-out;
    -moz-transition: all 0.30s ease-in-out;
    -ms-transition: all 0.30s ease-in-out;
    -o-transition: all 0.30s ease-in-out;

}.form-style-9 ul li  .field-style:focus{
    box-shadow: 0 0 5px #B0CFE0;
    border:1px solid #B0CFE0;
}
.form-style-9 ul li .field-split{
    width: 49%;
}
.form-style-9 ul li .field-full{
    width: 100%;
}
.form-style-9 ul li input.align-left{
    float:left;
}
.form-style-9 ul li input.align-right{
    float:right;
}
.form-style-9 ul li textarea{
    width: 100%;
    height: 100px;
}
.form-style-9 ul li input[type="button"],
.form-style-9 ul li input[type="submit"] {
    -moz-box-shadow: inset 0px 1px 0px 0px #3985B1;
    -webkit-box-shadow: inset 0px 1px 0px 0px #3985B1;
    box-shadow: inset 0px 1px 0px 0px #3985B1;
    background-color: #216288;
    border: 1px solid #17445E;
    display: inline-block;
    cursor: pointer;
    color: #FFFFFF;
    padding: 8px 18px;
    text-decoration: none;
    font: 12px Arial, Helvetica, sans-serif;
}
.form-style-9 ul li input[type="button"]:hover,
.form-style-9 ul li input[type="submit"]:hover {
    background: linear-gradient(to bottom, #2D77A2 5%, #337DA8 100%);
    background-color: #28739E;
}



h2 {
	font: 45px Tahoma, Helvetica, Arial, Sans-Serif;
	text-align: center;
	color: #216288;
    text-shadow: 0px 2px 3px #555;
}

</style>

</head>
<body background="/Mas Proje/images/Background Wallpaper.jpg">

<form class="form-style-9" action="" method="post">
<h2>Admin Şifre Değiştirme</h2>
<ul>

<!--<li>
    <input type="text" name="admin_adi" class="field-style field-split align-left" placeholder="Admin Adınızı Giriniz:"/>
</li>-->

<li>
    <input type="password" name="sifre" class="field-style field-split align-left" placeholder="Yeni Şifrenizi Giriniz:"/>
</li>

<li>
    <input type="password" name="sifre_bir_daha" class="field-style field-full align-none" placeholder="Yeni Şifrenizi Bir Daha Giriniz:"/>
</li>

<li>
    <input type="submit" value="Şifreyi Değiştir" name="degistir_btn"/>
</li>

<li>
    <input type="submit" value="Önceki Sayfaya Dön" name="önceki_sayfa_btn"/>
</li>

</ul>
</form>

</body>
</html>
