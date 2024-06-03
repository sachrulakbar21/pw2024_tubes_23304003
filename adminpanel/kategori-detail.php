<?php 
    require "session.php";
    require "../function.php";

    $id = $_GET['d'];

    $query = mysqli_query($con,"SELECT * FROM kategori WHERE id='$id'");
    $data = mysqli_fetch_array($query);
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
        <h2>Detail Kategori</h2>

        <div class="col-12 col-md-6">
            <form action="" method="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" name="kategori" id="kategori" class="form-control" value="<?php echo $data['nama'];?>">
                
                </div>

                <div class="mt-5 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
                    <button type="submit" class="btn btn-danger" name="deleteBtn">Hapus</button>
                </div>
            </form>

            <?php 
                if(isset($_POST["editBtn"])){
                    $kategori = htmlspecialchars($_POST['kategori']);

                    if($data['nama']==$kategori){
                        ?> 
                            <meta http-equiv="refresh" content="0`; url=kategori.php"/>
                        <?php
                    }
                    else{
                        $query = mysqli_query($con, "SELECT * FROM kategori WHERE nama='$kategori'");
                        $jumlahData = mysqli_num_rows($query);
                        
                        if($jumlahData> 0){
                            ?>
                            <div class="alert alert-warning col-12 col-md-3 mt-3"  role="alert">
                                    Data Sudah Ada
                            </div>
                                <?php
                        }

                        else{
                            $querySimpanData = mysqli_query($con,"UPDATE  kategori SET nama='$kategori' WHERE id='$id'");

                            if($querySimpanData > 0){
                                ?>
                                    <div class="alert alert-info" role="alert">
                                      Data DiUpdate!
                                    </div>

                                <meta http-equiv="refresh" content="1`; url=kategori.php" /> 
                                <?php
                                
                            }
                        }
                    }
                }

                if(isset($_POST["deleteBtn"])){
                    $queryHapusData = mysqli_query( $con,"DELETE FROM kategori WHERE id='$id'");

                    if($queryHapusData > 0){
                    ?>
                        <div class="alert alert-info col-12 col-md-3 mt-3"  role="alert">
                            Data Dihapus
                        </div>

                        <meta http-equiv="refresh" content="1`; url=kategori.php" />
                    <?php
                    }

                    else{
                        echo mysqli_error( $con);
                    }
                }
            ?>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>