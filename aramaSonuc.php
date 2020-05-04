<html xmlns="http://www.w3.org/1999/xhtml" lang="tr"> 
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<!------ Include the above in your HEAD tag ---------->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<head>
 
 <title>Arama Sonucu</title>
 
 <style>
    html, body, .container-table {
       height: 100%;
    }
    
    .container-table {
       display: table;
    }

    .vertical-center-row {
       display: table-cell;
       vertical-align: middle;
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


 </style>
 
</head>
	
<body>
    
<div class="container container-table">
    <div class="row vertical-center-row">
        <div class="text-center col-md-4 col-md-offset-4">
<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">Sistem</th>
      <th scope="col">Birim</th>
      <th scope="col">Kart No</th>
      <th scope="col">Seri No</th>
      <th scope="col">Ürün Adı</th>
      <th scope="col">Arıza Tipi</th>
      <th scope="col">Sehir</th>
      <th scope="col">Giriş Tarihi</th>
      <th scope="col">Proje Adı</th>
      <th scope="col">Ek Bilgi</th>
    </tr>
  </thead>
  <tbody>
    <?php
                            
            session_start();
            $sistem = $_SESSION['sistem'];
            $birim = $_SESSION['birim'];
            $kart_no = $_SESSION['kart_no'];
            $seri_no = $_SESSION['seri_no'];
            $urun_adi = $_SESSION['urun_adi'];
            $ariza_tipi = $_SESSION['ariza_tipi'];
            $sehir = $_SESSION['sehir'];
            $giris_tarihi = $_SESSION['giris_tarihi'];
            $proje_adi = $_SESSION['proje_adi'];
            $ek_bilgi = $_SESSION['ek_bilgi'];
            $resim = $_SESSION['resim'];
                            
            echo "<tr>
			<td>$sistem</td>
			<td>$birim</td>
			<td>$kart_no</td>
			<td>$seri_no</td>
            <td>$urun_adi</td>
            <td>$ariza_tipi</td>
            <td>$sehir</td>
            <td>$giris_tarihi</td>
            <td>$proje_adi</td>
            <td>$ek_bilgi</td>
            <td><img src='documents/".$resim."'></td>
			</tr>";
                            
    ?>
  
  </tbody>
</table>
        </div>
    </div>
</div>


    
</body>

</html>