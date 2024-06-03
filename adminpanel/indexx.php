<?php
    require "session.php";
    require "../function.php";

    $queryKategori= mysqli_query($con, "SELECT * FROM kategori");
    $jumlahKategori=mysqli_num_rows($queryKategori);
   
    $queryProduk=mysqli_query($con,"SELECT * FROM produk");
    $jumlahProduk=mysqli_num_rows($queryProduk);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicfy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>
    .kotak {
        border: solid;
    }
    .summary-kategori{
        background-color: #87CEEB;
        border-radius: 15px;
    }

    .summary-produk{
        background-color: #0a516b;
        border-radius: 15px;
    }
    .no-decoration{
        text-decoration: none;
    }
</style>

<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-home mr-4"></i>Home 
                </li>
            </ol>
        </nav>
        <h2>Halo <?php echo $_SESSION['username'];?></h2>

        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="summary-kategori p-3">
                        <div class="row">
                            <div class="col-6">
                                <i class="fas fa-align-justify fa-7x text-black-60"></i>
                            </div>
                                <div class="col-6 text-black">
                                <h3 class="fs-2">Kategori</h3>
                                <p class="fs-4"><?php echo $jumlahKategori; ?> Kategori</p>
                                <p><a href="kategori.php" class="text-black no-decoration">Details</a></p>
                            </div>
                        </div>   
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <div class="summary-produk p-3">
                        <div class="row">
                            <div class="col-6">
                                <i class="fas fa-box fa-7x text-white"></i>
                            </div>
                            <div class="col-6 text-black">
                                <h3 class="fs-2">Produk</h3>
                                <p class="fs-4"><?php echo"$jumlahProduk"; ?> Produk</p>
                                <p><a href="kategori.php" class="text-black no-decoration">Details</a></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>