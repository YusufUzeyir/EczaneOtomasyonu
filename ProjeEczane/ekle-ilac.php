<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>İlaç Ekleme Sayfası</title>
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


<form action="islem-ilac.php" method="post" style="padding-top: 35px;">
  <div class="form-group">
    <label for="exampleInputEmail1">ID</label>
    <input name="id" type="text" class="form-control" id="exampleInputPassword1" >
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Üretici Firma</label>
    <input name="uretici_firma" type="text" class="form-control" id="exampleInputPassword1" >
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Dozaj</label>
    <input name="dozaj" type="text" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Fiyat</label>
    <input name="fiyat" type="text" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">İlaç Adı</label>
    <input name="ilac_adi" type="text" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Kategori</label>
    <input name="kategori" type="text" class="form-control" id="exampleInputPassword1" >
  </div>
 
  <button name="urunekle" type="submit" class="btn btn-primary">Ürün Ekle</button>
</form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

</body>
</html>