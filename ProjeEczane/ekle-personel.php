<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Personel Ekleme Sayfası</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
		body {
			min-height: 100vh;
     width: 100%;
     background-color: #485461;
     background-image: linear-gradient(135deg, #485461 0%, #28313b 74%);
     overflow-x: hidden;
    transform-style: preserve-3d;
		 }
	</style>
  </head>
<body>
<div class="container">


<form action="islem-personel.php" method="post" style="padding-top: 35px;">
  <div class="form-group">
    <label for="exampleInputEmail1">ID</label>
    <input name="id" type="text" class="form-control" id="exampleInputPassword1" >
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Ad</label>
    <input name="personel_ad" type="text" class="form-control" id="exampleInputPassword1" >
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Soyad</label>
    <input name="personel_soyad" type="text" class="form-control" id="exampleInputPassword1">
  </div>

  <div class="form-group">
        <label for="exampleInputPassword1">Cinsiyet</label><br>
        <select name="cinsiyet">
        <?php
                $selected = "Erkek";
                $options = array('Erkek', 'Kadın');
                
                foreach($options as $option){
                    if($selected == $option) {
                        echo "<option selected='selected' value='$option'>$option</option>";
                    }
                    else {
                        echo "<option value='$option'>$option</option>";
                    }
                }
                
            ?>
        </select>
      </div>
      
  <div class="form-group">
    <label for="exampleInputPassword1">Doğum Tarihi</label>
    <input name="dogum_tarihi" type="text" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Giriş Tarihi</label>
    <input name="giris_tarih" type="text" class="form-control" id="exampleInputPassword1" >
  </div>
 
  <button name="personelekle" type="submit" class="btn btn-primary">Personel Ekle</button>
</form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

</body>
</html>