<?php
//şifre değiştirme ayarlar.php de. buton yerine <a> tag i kullanıldı.
/*if(isset($_POST['sifre_degistir_btn'])){
    header('Location: sifreDegistir.php');
}*/
?>

<?php
include "adminConfig.php";

// Check user login or not
if(!isset($_SESSION['uname'])){
    header('Location: login.php');
}

//logout kısmı Logout.php sayfasında. buton yerine <a> tag i kullanıldı. 
// logout
/*if(isset($_POST['cikis_btn'])){
    session_destroy();
    header('Location: login.php');
}*/
?>

<?php
$host = "localhost"; /* Host name */
$username = "root"; /* User */
$password = ""; /* Password */
$dbname = "sistem_urun_db"; /* Database name */

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
  // here comes your delete query: use $_POST['deleteItem'] as your id

if(isset($_POST['sil_btn']) and is_numeric($_POST['sil_btn']))
{
 
   //echo $_POST['sil_btn'];
  
  //echo $delete;
  $delete = $_POST['sil_btn'];
  //echo "<script>$('#delete').modal('show')</script>";

  if ($stmt = $conn->prepare("DELETE FROM urunsistemtablo WHERE ID = ?")) {

       // Bind the variables to the parameter as strings. 
       $stmt->bind_param("s", $delete);
 
       // Execute the statement.
       $stmt->execute();
 
       // Close the prepared statement.
       $stmt->close();
  }

}

?>


<?php
$host = "localhost"; /* Host name */
$username = "root"; /* User */
$password = ""; /* Password */
$dbname = "sistem_urun_db"; /* Database name */

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
 
if (isset($_POST['ekle_submit'])) {
 
   $ID = $_SESSION['ID'];
   //echo $ID;
   $sistem = $_POST['sistem'];
   $birim = $_POST['birim'];
   $kart_no = $_POST['kart_no'];
   $seri_no = $_POST['seri_no'];
   $urun_adi = $_POST['ürün_adi'];
   $ariza_tipi = $_POST['arıza_tipi'];
   $sehir = $_POST['sehir'];
   $giris_tarihi = strtotime($_POST['tarih']);
   $giris_tarihi = date('Y-m-d', $giris_tarihi);

   $proje_adi = $_POST['proje_adi'];
   $ek_bilgi = $_POST['bilgi'];

   $upload_image = $_FILES['resim']['name'];
   $folder = "documents/";

   move_uploaded_file($_FILES['resim']['tmp_name'], "$folder".$_FILES['resim']['name']);

 if ($stmt = $conn->prepare("INSERT INTO urunsistemtablo (Kullanici_ID, Sistem, Birim, KartNo, SeriNo, ArizaTipi, UrunAdi, Sehir, GirisTarihi, ProjeAdi, ResimYol, ResimAD, EkBilgi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
 
    // Bind the variables to the parameter as strings. 
    $stmt->bind_param("sssssssssssss", $ID, $sistem, $birim, $kart_no, $seri_no, $ariza_tipi, $urun_adi, $sehir, $giris_tarihi, $proje_adi, $upload_image, $folder, $ek_bilgi);
 
    // Execute the statement.
    $stmt->execute();
 
    // Close the prepared statement.
    $stmt->close();
 }

  else{
    echo "<script>alert('Hatalı Giriş');</script>";
  }

}

?>

<?php
$host = "localhost"; /* Host name */
$username = "root"; /* User */
$password = ""; /* Password */
$dbname = "sistem_urun_db"; /* Database name */

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['ara_btn']))
{
 
 if ($_POST['ara_txtbox'] != ''){
    //kart no'ya göre arama yapıyor.
    $ara_txtbox = $_POST['ara_txtbox'];
    $ID = $_SESSION['ID'];
 
    if ($stmt = $conn->prepare("SELECT Sistem, Birim, KartNo, SeriNo, UrunAdi, ArizaTipi, Sehir, GirisTarihi, ProjeAdi, EkBilgi, ResimYol FROM urunsistemtablo WHERE KartNo=? AND Kullanici_ID=?")) {
 
       // Bind a variable to the parameter as a string. 
       $stmt->bind_param("ss", $ara_txtbox, $ID);
 
       // Execute the statement.
       $stmt->execute();
 
       // Get the variables from the query.
       $stmt->bind_result($sistem, $birim, $kart_no, $seri_no, $urun_adi, $ariza_tipi, $sehir, $giris_tarihi, $proje_adi, $ek_bilgi, $resim);
    
       // Fetch the data.
       $stmt->fetch();
    
       //session_start();
       $_SESSION['sistem'] = $sistem;
       $_SESSION['birim'] = $birim;
       $_SESSION['kart_no'] = $kart_no;
       $_SESSION['seri_no'] = $seri_no;
       $_SESSION['urun_adi'] = $urun_adi;
       $_SESSION['ariza_tipi'] = $ariza_tipi;
       $_SESSION['sehir'] = $sehir;
       $_SESSION['giris_tarihi'] = $giris_tarihi;
       $_SESSION['proje_adi'] = $proje_adi;
       $_SESSION['ek_bilgi'] = $ek_bilgi;
       $_SESSION['resim'] = $resim;
  
       // Display the data.
    
       echo "<script>
     function open_me(h_rf)
     {
         window.open(h_rf,'_blank','width=1600,height=550,toolbar=0,menubar=0,location=0,status=0,scrollbars=1,resizable=0,left=0,top=0');
    
         return false;
     }

     open_me('http://localhost:8080/Mas Proje/aramaSonuc.php');
     </script>";
 
       // Close the prepared statement.
       $stmt->close();
 
    }

     else{
       echo "<script>alert('girdiğiniz Kart Numarasına Ait Kayıt Bulunmamaktadır!!!');</script>";
     }
  
  }
  
  else
  {
    echo "<script>alert('Lütfen Geçerli Bir Kart Numarası Giriniz!');</script>"; 
  }
 
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" lang="tr"> 
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!------ Include the above in your HEAD tag ---------->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<head>
 
 <title>Kullanıcı Ana Sayfa</title>
 
  <style>
   .scrollable-menu {
	       height: auto;
        max-height: 200px;
        overflow-x: hidden;
   }
   
   .form-style-9 {
	       max-width: 600px;
        background: #FAFAFA;
        padding: 30px;
        margin: 50px auto;
        box-shadow: 1px 1px 25px rgba(0, 0, 0, 0.35);
        border-radius: 10px;
        border: 6px solid #305A72;
   }
   
   .form-style-9 ul {
	       padding:0;
        margin:0;
        list-style:none;
   }
   
   .form-style-9 ul li {
	       display: block;
        margin-bottom: 10px;
        min-height: 35px;
   }
   
   .form-style-9 ul li  .field-style {
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
   }

   .form-style-9 ul li  .field-style:focus {
	       box-shadow: 0 0 5px #B0CFE0;
        border:1px solid #B0CFE0;
   }
   
   .form-style-9 ul li .field-split {
	       width: 49%;
   }
   
   .form-style-9 ul li .field-full {
	       width: 100%;
   }
   
   .form-style-9 ul li input.align-left {
	       float:left;
   }

   .form-style-9 ul li input.align-right {
	       float:right;
   }

   .form-style-9 ul li textarea {
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
   
    * {
        margin: 0;
        padding: 0;
     }

     img {
        height: 150px;
        width: auto
  } 

     td:hover img {
        background: red;
        height: 200px;
     }
     
     
     #link {
        color: rgb(255, 0, 0);
        text-decoration: none;
        text-transform: uppercase;
        font-size: 16px;
        font-weight: bold;
        font-family: Arial;
      }

     #link:hover {
        background-color: white;
        
     }

     #link:active {
        background-color: rgb(233, 230, 97);
     }

     #navbar-links:hover{
        background-color: #696969;
     }
     
     #navbar-links
     {
        color: white;
     }
     
     
     body {
        padding-top: 70px;
     }
     
     .navbar.navbar-inverse {
        border: none;
     }
    
     .navbar .navbar-brand {
        padding-top: 0px;
     }
    
     .navbar .navbar-brand img {
        height: 50px;
     }

   
  </style>
</head>

<script type="text/javascript">
    $(function() {
        $.mask.definitions['~'] = "[+-]";
        $("#kart_no").mask("M999-9999-R99", {
       
        }); 
    });
    
    $(document).ready(function() {   
            var sideslider = $('[data-toggle=collapse-side]');
            var sel = sideslider.attr('data-target');
            var sel2 = sideslider.attr('data-target-2');
            sideslider.click(function(event){
                $(sel).toggleClass('in');
                $(sel2).toggleClass('out');
            });
            
            var categories = {
    "Hiçbirşey":[{value:'Birim Seçmek İçin Sistem Seçiniz', text:'Birim Seçmek İçin Sistem Seçiniz'}],
    "Kapı Zili":[{value:'Mas 1', text:'Mas 1'},{value:'Mas 2', text:'Mas 2'}],
    "Kapı Otomatiği":[{value:'Mas 4', text:'Mas 4'},{value:'Mas 5', text:'Mas 5'},{value:'Mas 10', text:'Mas 10'}],
    "Sayaç":[{value:'Mas 6', text:'Mas 6'},{value:'Mas 7', text:'Mas 7'}],
    "Kablo":[{value:'Mas 8', text:'Mas 8'},{value:'Mas 9', text:'Mas 9'}]
    };
function selectchange(){
    var select = $('[name=birim]');
    select.empty();
    $.each(categories[$(':selected', this).text()], function(){
        select.append('<option value="'+this.value+'">'+this.text+'</option>');
    });
}
$(function(){
    $('[name=sistem]').on('change', selectchange);
});
    
    });      
   


</script>
	
<body background="/Mas Proje/images/Background Wallpaper.jpg">
 
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>

      </button>
      <a class="navbar-brand">
        <!--<img src="/Mas Proje/profilePictures/marshmallows-350x150.jpg">-->
        <?php
        
        $connection=Mysql_connect('localhost','root','');
        if(!$connection)
        {
            echo 'connection is invalid';
        }
        else
        {
            Mysql_select_db('kullanicidb',$connection);

        }
        
        $ID = $_SESSION['ID'];
        $fetch = mysql_query("SELECT * FROM users WHERE ID=$ID")or
        die(mysql_error());
        $num=Mysql_num_rows($fetch);
        
        if($num>0) {
         for($i=0;$i<$num;$i++) {
             $row=mysql_fetch_row($fetch);
             echo "<img src='profilePictures/".$row[4]."'>";
        
         }
         
        }
        
        ?>
      </a>
      
        <a id="navbar-links" style="font-size: 24px">
        <?php
        
        $connection=Mysql_connect('localhost','root','');
        if(!$connection)
        {
            echo 'connection is invalid';
        }
        else
        {
            Mysql_select_db('kullanicidb',$connection);

        }
        
        $ID = $_SESSION['ID'];
        $fetch = mysql_query("SELECT * FROM users WHERE ID=$ID")or
        die(mysql_error());
        $num=Mysql_num_rows($fetch);
        
        if($num>0) {
         for($i=0;$i<$num;$i++) {
             $row=mysql_fetch_row($fetch);
             echo "Hoşgeldiniz ";
             echo "$row[1]";
        
         }
         
        }
        
        ?>
        </a>

    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     <form method="post" action="">
      <ul class="nav navbar-nav">
       
        <li class="active"><a id="navbar-links" >Ana Sayfa <span class="sr-only">(current)</span></a>

        </li>
        <li><a id="navbar-links" href="ayarlar.php">Ayarlar </a>

        </li>
        <li><a id="navbar-links" href="logout.php">Çıkış </a>

        </li>
        <li><a><input type="text" name="ara_txtbox" style="width: 250px;" placeholder="Kart No'ya Göre Arama Yap"></a>

        </li>
        
        <li><a><button type="submit" class="btn btn-success" name="ara_btn">Ara</button></a></li>
        
      </ul>
     </form>
    </div>
  </div>
</nav>


<form class="form-style-9" method="post" action="" enctype="multipart/form-data">
<ul>

<li>
 
<select name="sistem" class="field-style field-split align-left">
    <option value="Hiçbirşey">Sistem Seçilmedi</option>
    <option value="Kapı Zili">Kapı Zili</option>
    <option value="Kapı Otomatiği">Kapı Otomatiği</option>
    <option value="Sayaç">Sayaç</option>
    <option value="Kablo">Kablo</option>
</select>

<select name="birim" class="field-style field-split align-right" >
    <option value="Birim Seçmek İçin Sistem Seçiniz">Birim Seçmek İçin Sistem Seçiniz</option>
</select>

</li>

<li>
    <input type="text" name="seri_no" class="field-style field-split align-right" placeholder="Seri No" required/> 
    <input type="text" name="kart_no" id="kart_no" class="field-style field-split align-left" placeholder="Kart No" required/>
</li>

<li>
    <input type="text" name="ürün_adi" class="field-style field-split align-right" placeholder="Ürün Adı" required/>
    <input type="text" name="arıza_tipi" class="field-style field-split align-left" placeholder="Arıza Tipi" required/>	 
</li>

<li>
<div class="custom-select" style="width:350px;">
  <select name="sehir" class="field-style field-split align-left">
    <option value="0">------</option>
    <option value="Adana">Adana</option>
    <option value="Adıyaman">Adıyaman</option>
    <option value="Afyonkarahisar">Afyonkarahisar</option>
    <option value="Ağrı">Ağrı</option>
    <option value="Amasya">Amasya</option>
    <option value="Ankara">Ankara</option>
    <option value="Antalya">Antalya</option>
    <option value="Artvin">Artvin</option>
    <option value="Aydın">Aydın</option>
    <option value="Balıkesir">Balıkesir</option>
    <option value="Bilecik">Bilecik</option>
    <option value="Bingöl">Bingöl</option>
    <option value="Bitlis">Bitlis</option>
    <option value="Bolu">Bolu</option>
    <option value="Burdur">Burdur</option>
    <option value="Bursa">Bursa</option>
    <option value="Çanakkale">Çanakkale</option>
    <option value="Çankırı">Çankırı</option>
    <option value="Çorum">Çorum</option>
    <option value="Denizli">Denizli</option>
    <option value="Diyarbakır">Diyarbakır</option>
    <option value="Edirne">Edirne</option>
    <option value="Elazığ">Elazığ</option>
    <option value="Erzincan">Erzincan</option>
    <option value="Erzurum">Erzurum</option>
    <option value="Eskişehir">Eskişehir</option>
    <option value="Gaziantep">Gaziantep</option>
    <option value="Giresun">Giresun</option>
    <option value="Gümüşhane">Gümüşhane</option>
    <option value="Hakkari">Hakkâri</option>
    <option value="Hatay">Hatay</option>
    <option value="Isparta">Isparta</option>
    <option value="Mersin">Mersin</option>
    <option value="İstanbul">İstanbul</option>
    <option value="İzmir">İzmir</option>
    <option value="Kars">Kars</option>
    <option value="Kastamonu">Kastamonu</option>
    <option value="Kayseri">Kayseri</option>
    <option value="Kırklareli">Kırklareli</option>
    <option value="Kırşehir">Kırşehir</option>
    <option value="Kocaeli">Kocaeli</option>
    <option value="Konya">Konya</option>
    <option value="Kütahya">Kütahya</option>
    <option value="Malatya">Malatya</option>
    <option value="Manisa">Manisa</option>
    <option value="Kahramanmaraş">Kahramanmaraş</option>
    <option value="Mardin">Mardin</option>
    <option value="Muğla">Muğla</option>
    <option value="Muş">Muş</option>
    <option value="Nevşehir">Nevşehir</option>
    <option value="Niğde">Niğde</option>
    <option value="Ordu">Ordu</option>
    <option value="Rize">Rize</option>
    <option value="Sakarya">Sakarya</option>
    <option value="Samsun">Samsun</option>
    <option value="Siirt">Siirt</option>
    <option value="Sinop">Sinop</option>
    <option value="Sivas">Sivas</option>
    <option value="Tekirdağ">Tekirdağ</option>
    <option value="Tokat">Tokat</option>
    <option value="Trabzon">Trabzon</option>
    <option value="Tunceli">Tunceli</option>
    <option value="Şanlıurfa">Şanlıurfa</option>
    <option value="Uşak">Uşak</option>
    <option value="Van">Van</option>
    <option value="Yozgat">Yozgat</option>
    <option value="Zonguldak">Zonguldak</option>
    <option value="Aksaray">Aksaray</option>
    <option value="Bayburt">Bayburt</option>
    <option value="Karaman">Karaman</option>
    <option value="Kırıkkale">Kırıkkale</option>
    <option value="Batman">Batman</option>
    <option value="Şırnak">Şırnak</option>
    <option value="Bartın">Bartın</option>
    <option value="Ardahan">Ardahan</option>
    <option value="Iğdır">Iğdır</option>
    <option value="Yalova">Yalova</option>
    <option value="Karabük">Karabük</option>
    <option value="Kilis">Kilis</option>
    <option value="Osmaniye">Osmaniye</option>
    <option value="Düzce">Düzce</option>
  </select>
</div>

</li>

<!--<li>
    <input type="text" name="son_durum" class="field-style field-split align-right" placeholder="Son Durum"/>
	<input type="text" name="degistirilen_parcalar" class="field-style field-split align-right" placeholder="Değiştirilen Parçalar"/>
</li>-->

<li>
	    <input type="date" name="tarih" class="field-style field-split align-left" required/>
</li>

<li>
     <input type="text" name="proje_adi" class="field-style field-split align-right" placeholder="Proje Adı" required/>
     <input type="file" name="resim" class="field-style field-split align-left" accept=".png, .jpg, .jpeg" required>
     <!-- inputta multiple='multiple' dersen birden fazla resim seçebilisin. form da enctype='multipart/form-data' -->
</li>

<li>
     <textarea name="bilgi" class="field-style" placeholder="Ek Bilgi" required></textarea>
</li>

<li>
     <input type="submit" value="Ekle" id="ekle_btn" name="ekle_submit"/>
</li>

</ul>
</form>


<div class="container" id="container">
	<div class="row">	
        
        <div class="col-md-12">
        <div class="table-responsive">
           <form method="post" action="">
              <table id="mytable" class="table table-bordred table-striped">
                   
    <tbody>
                   
              
<?php
$connection=Mysql_connect('localhost','root','');
        if(!$connection)
        {
            echo 'connection is invalid';
        }
        else
        {
            Mysql_select_db('sistem_urun_db',$connection);

        }
        
if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
  //we give the value of the starting row to 0 because nothing was found in URL
  $startrow = 0;
//otherwise we take the value from the URL
} else {
  $startrow = (int)$_GET['startrow'];
}

$ID = $_SESSION['ID'];
$fetch = mysql_query("SELECT * FROM urunsistemtablo WHERE Kullanici_ID=$ID  LIMIT $startrow, 10")or
die(mysql_error());
   $num=Mysql_num_rows($fetch);
        if($num>0)
        {
        
        //checkbox'ları kaldırdım
        //<th <input type=checkbox id=checkall> </th>>
        echo "<thead>";
        echo "
        <th>Sistem</th>
        <th>Birim</th>
        <th>Kart No</th>
        <th>Seri No</th>
        <th>Arıza Tipi</th>
        <th>Ürün Adı</th>
        <th>Şehir</th>
        <th>Giriş Tarihi</th>
        <th>Resim</th>
        <th>Proje Adı</th>
        <th>Ek Bilgi</th>";
        echo "</thead>";
        
        for($i=0;$i<$num;$i++)
        {
        $row=mysql_fetch_row($fetch);
        echo "<tbody>";
        echo "<tr>";
        //echo"<td> <input type=checkbox class=checkthis /></td>";
        echo"<td>$row[2]</td>";
        echo"<td>$row[3]</td>";
        echo"<td>$row[4]</td>";
        echo"<td>$row[5]</td>";
        echo"<td>$row[6]</td>";
        echo"<td>$row[7]</td>";
        echo"<td>$row[8]</td>";
        echo"<td>$row[11]</td>";
        echo "<td><img src='documents/".$row[14]."'></td>";
        echo"<td>$row[15]</td>";
        echo"<td>$row[16]</td>";
        //düzenle yani revize fonksiyonu sadece admin kısmında var. kullanıcı kısmına ekelemedim
        //echo "<td><p data-placement='top' data-toggle='tooltip' title='Düzenle'><button style='height:35px; width:35px' value='$row[1]' id='duzenle_btn' name='duzenle_btn' class='btn btn-primary btn-xs' data-title='Edit'><span class='glyphicon glyphicon-pencil'></span></button></p></td>";
        echo "<td><p data-placement='top' data-toggle='tooltip' title='Sil'><button style='height:35px; width:35px' name='sil_btn' value='$row[1]' class='btn btn-danger btn-xs' data-title='Delete'><span class='glyphicon glyphicon-trash'></span></button></p></td>";
        echo"</tr>";
        echo "<tbody>";
        
        }//for
        
        //echo"";
        
        }
//now this is the link..
echo '<a id="link" href="'.$_SERVER['PHP_SELF'].'?startrow='.($startrow+10).'">İleri</a>';

$prev = $startrow - 10;

//only print a "Previous" link if a "Next" was clicked
if ($prev >= 0)
    echo '<a id="link" href="'.$_SERVER['PHP_SELF'].'?startrow='.$prev.'">Geri</a>';
    
?>
               </table>
            </form>
            </div>  
        </div>
	  </div>
</div>

</body> 
</html>