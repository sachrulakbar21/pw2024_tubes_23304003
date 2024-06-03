<?php
    require "session.php";
    require "../function.php";

    $queryProduk = mysqli_query($con,"SELECT * FROM produk");
    $jumlahProduk = mysqli_num_rows($queryProduk);
    
    $queryKategori =mysqli_query( $con,"SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>
    .no-decoration{
        text-decoration: none;
    }

    form div{

        margin-bottom: 10px;
    }
</style>

<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="indexx.php" class="no-decoration text-muted"><i class="fas fa-home mr-4"></i>Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Produk
                </li>
            </ol>
        </nav>


        <!-- tambah produk -->
        <div class="my-5 col-12 col-md-6">
                <h3> Tambah Produk</h3>

                <form action="" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="my-3 ">
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori" class="form-control" required>
                            <option value="">Pilih Kategori</option>
                            <?php 
                                while($data=mysqli_fetch_array($queryKategori)){
                            ?>
                                <option value="<?php echo $data['nama'];?>"><?php echo$data['nama']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="harga"> Harga</label>
                        <input type="number" class="form-control" name="harga" required>
                    </div>

                    <div>
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>

                    <div>
                        <label for="detail">Detail</label>
                        <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                    <div>
                        <label for="stok_tersedia">Stok Tersedia</label>
                        <select name="stok_tersedia" id="stok_tersedia" class="form-control">
                            <option value="tersedia">Tersedia</option>
                            <option value="habis">Habis</option>
                        </select>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    </div>
                </form>

                <?php 
                    if (isset($_POST['simpan'])){
                        $nama = htmlspecialchars($_POST['nama']);
                        $nama = htmlspecialchars($_POST['kategori']);
                        $nama = htmlspecialchars($_POST['harga']);

                        if($nama=='' || $kategoori=='' || $harga==''){
                            ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                      Nama Kategori & Harga Wajib Diisi
                                </div>

                            <?php
                        }
                    }
                ?>

                <?php 
                    if(isset($_POST["simpan_kategori"])){
                        $kategori = htmlspecialchars($_POST["kategori"]);

                        $queryNoDoubleData = mysqli_query($con,"SELECT nama FROM kategori WHERE nama='$kategori'");
                        $KategoriBaru = mysqli_num_rows($queryNoDoubleData);

                        if($KategoriBaru > 0){
                            ?>
                                <div class="alert alert-warning col-12 col-md-3" class="mt-3" role="alert">
                                    Data Sudah Ada
                                </div>
                            <?php
                        }

                        else{
                            $querySimpanData = mysqli_query($con,"INSERT INTO kategori (nama) VALUES ('$kategori')");
                            if($querySimpanData > 0){
                                ?>
                                    <div class="alert alert-info" role="alert">
                                      Data Disimpan!
                                    </div>

                                <meta http-equiv="refresh" content="1`; url=kategori.php" /> 
                                <?php
                                
                            }
                            else{
                                echo mysqli_error($con);
                            }
                        }
                    }
                ?>
            </div>

        <div class="mt-3">
            <h2>List Produk</h2>

            <div class="table-responsive mt-4">
                <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if($jumlahProduk==0){
                                    ?>
                                        <tr>
                                            <td colspan="5" class="text-center"> Produk Tidak Ada</td>
                                        </tr>
                                    <?php
                                }
                                else{
                                    $jumlah =1;
                                    while($data=mysqli_fetch_array($queryProduk)){
                                        ?>
                                            <tr>
                                                <td><?php echo $jumlah;?> </td>
                                                <td><?php echo $data['nama'];?> </td>
                                                <td><?php echo $data['kategori_id'];?> </td>
                                                <td><?php echo $data['harga'];?> </td>
                                                <td><?php echo $data['ketersediaan_stok'];?> </td>
                                            </tr>
                                        <?php

                                        $jumlah++;
                                    }
                                }
                            ?>
                        </tbody>
                </table>
            </div>
        </div>
    </div>
    



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>