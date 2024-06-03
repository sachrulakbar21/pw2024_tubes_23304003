<?php
    require "session.php";
    require "../function.php";

    $queryKategori = mysqli_query($con,"SELECT * FROM kategori");
    $jumlahKategori = mysqli_num_rows($queryKategori);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>
    .no-decoration{
        text-decoration: none;
    }
</style>

<body>
    <?php require "navbar.php";?>
        <div class="container mt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="indexx.php" class="no-decoration text-muted"><i class="fas fa-home mr-4"></i>Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Kategori
                    </li>
                </ol>
            </nav>

            <div class="my-5 col-12 col-md-6">
                <h3> Tambah Kategori</h3>

                <form action="" method="post">
                    <div>
                        <label for="kategori">Kategori</label>
                        <input type="text" id="kategori" name="kategori" placeholder="Masukan nama kategori" class="form-control">
                    </div>
                    <div class="my-3 ">
                        <button class="btn btn-primary" type="submit" name="simpan_kategori">Simpan</button>
                    </div>
                </form>

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
                <h2>List Kategori</h2>

                <div class="table-responsive mt-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php 
                                if($jumlahKategori == 0){ 
                           ?>

                                <tr>
                                    <td colspan="3" class="text-center"> Kategori Tidak Ada</td>
                                </tr>
                           <?php 
                                }
                                else {
                                    $number = 1;
                                    while ($data=mysqli_fetch_array($queryKategori)) {
                                ?>
                                  <tr>
                                    <td><?php echo $number; ?></td>
                                    <td> <?php echo $data['nama']; ?></td>
                                    <td>
                                        <a href="kategori-detail.php?d=<?php echo $data ['id']; ?>" class="btn btn-info"> 
                                        <i class="fa-solid fa-magnifying-glass"></i></a>
                                    </td>
                                  </tr>  
                            <?php
                                $number++;
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