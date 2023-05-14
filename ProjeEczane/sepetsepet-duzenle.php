<?php
include 'baglanti.php';

$urunsor = $baglanti->prepare("SELECT * FROM stok WHERE barkod=:barkod");
$urunsor->execute(
  array(
    'barkod' => $_GET['barkod']


  )
);
$uruncek = $urunsor->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>Sepet Ekleme Sayfası</title>
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

    <form action="sepetsepet-islem.php" method="post" style="padding-top: 35px;">
      <div class="form-group">
        <label for="exampleInputEmail1">Barkod</label>
        <input name="barkod" value="<?php echo $uruncek['barkod'] ?>" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      </div>

      <div class="form-group">
        <label for="exampleInputPassword1">Hasta ID</label><br>
        <select name="hasta_id">
          <?php
          $conn = mysqli_connect("localhost", "root", "", "eczane3");
          $sql = "SELECT * FROM hasta";
          $result1 = mysqli_query($conn, $sql);
          ?>
          <?php while ($row1 = mysqli_fetch_array($result1)) :; ?>
            <option value="<?php echo $row1[0]; ?>"><?php echo $row1[0]; ?></option>
          <?php endwhile; ?>
        </select>
      </div>


      <div class="form-group">
        <label for="exampleInputPassword1">Adet</label>
        <input name="adet" type="text" class="form-control" id="exampleInputPassword1">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1"></label>
        <input name="fiyat" value="<?php echo $uruncek['fiyat'] ?>" type="hidden" class="form-control" id="exampleInputPassword1">
      </div>


      <input type="hidden" name="barkod" value="<?php echo $uruncek['barkod'] ?>">

      <button name="sepetekle" type="submit" class="btn btn-primary">Sepete Ekle</button>
    </form>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

</body>

</html>