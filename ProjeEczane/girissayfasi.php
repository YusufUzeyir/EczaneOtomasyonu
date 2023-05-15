<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OtoPharmacy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">




    <style>
        .gradient-custom-2 {
            background: #fccb90;

            background: -webkit-linear-gradient(to right, #485461, #28313b);

            background: linear-gradient(to right, #485461, #28313b);
        }

        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh !important;
            }
        }

        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }
        }
    </style>



</head>

<body style="background-color: #6c747e;">
    <section class="h-100 gradient-form">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="logo.png" style="width: 185px;" alt="logo">
                                    </div>

                                    <form><br>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example11">Kullanıcı Adı</label>
                                            <input type="email" id="kullanici" class="form-control" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example22">Şifre</label>
                                            <input type="password" id="sifre" class="form-control" />
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="button">Log in</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <img src="animation.gif" alt="animated GIF">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </section>

    <script>
  document.querySelector(".btn").addEventListener("click", function() {
    var username = document.getElementById("kullanici").value;
    var password = document.getElementById("sifre").value;

    if (username === "admin" && password === "admin") {
      window.location.href = "anasayfa.php";
    } else {
      alert("Hatalı kullanıcı adı veya şifre!");
      window.location.href = "girissayfasi.php";
    }
  });
</script>

</body>
</html>