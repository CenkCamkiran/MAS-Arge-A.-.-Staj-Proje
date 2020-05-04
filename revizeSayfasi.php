<?php
session_start();
$id=$_GET["value"];

//echo $id;
 
 if (isset($_POST['degistir_btn']))
{
  
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

$sistem = $_POST['sistem'];
$birim = $_POST['birim'];
$kart_no = $_POST['kart_no'];
$urun_adi = $_POST['urun_adi'];
$revize_nedeni = $_POST['revize_nedeni'];
$yapilan_islem = $_POST['yapilan_islem'];

//resim al

/*$upload_image = $_FILES['_resim']['name'];
$folder = "documents/";

move_uploaded_file($_FILES['_resim']['tmp_name'], "$folder".$_FILES['_resim']['name']);*/


 if ($stmt = $conn->prepare("UPDATE urunsistemtablo SET Sistem=? , Birim=? , KartNo=? , UrunAdi=? , Revize_Nedeni=? , YapilanIslem=? WHERE ID=?")) {
 
    // Bind the variables to the parameter as strings. 
    $stmt->bind_param("sssssss", $sistem, $birim, $kart_no, $urun_adi, $revize_nedeni, $yapilan_islem, $id);
 
    // Execute the statement.
    $stmt->execute();
 
    // Close the prepared statement.
    $stmt->close();
    
    //iş bittikten sonra pencereyi kapatcak kod
    echo "<script>window.close();</script>";
}

else
{
 echo "<script>alert('Hata!! Bir daha giriş yapınız.');</script>";
}


}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" lang="tr"> 
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>

<head>
  
	<title>Admin Revize</title>
  
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
   
  </style>
   
   <script type="text/javascript">
    $(function() {
        $.mask.definitions['~'] = "[+-]";
        $("#kart_no").mask("M999-9999-R99", {
       
        }); 
    });
    
    $(document).ready(function() {   
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
	

</head>

<body>
  
  <form class="form-style-9" method="post" action="">
<ul>
    <p style="font-size: 25px; color: rgb(48,90,114);" class="field-style field-split align-left"><b>Veri Revize Formu</b></p>
  
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
    <input type="text" name="urun_adi" class="field-style field-split align-left" placeholder="Ürün" />
    <input type="text" name="kart_no" id="kart_no" class="field-style field-split align-right" placeholder="Kart No" />
</li>

<li>
    <input type="text" name="yapilan_islem" class="field-style field-split align-left" placeholder="Yapılan İşlem" />
</li>

<li>
    <textarea name="revize_nedeni" class="field-style" placeholder="Revize Nedeni"></textarea>
</li>

<li>
<input type="submit" value="Değiştir" name='degistir_btn'/>
</li>

</ul>
</form>

</body>
</html>