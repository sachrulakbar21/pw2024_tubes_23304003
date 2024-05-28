<?php
    session_start();
    require "../function.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<style>
    .main{
        height: 100vh;
    }

    .login-box{
        width: 500px;
        height: 300px;
        box-sizing: border-box;
        border-radius: 15px;
    }

    .nama-toko {
        justify-content: center;
    }

    .container h2 {
        cursor: pointer;
    }
</style>

<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="login-box p-5 shadow">
            <form action="" method="post">
                <div>
                    <label for="username">Username</labe>
                    <input type="text" class="form-control" name="username" id="username">
                </div>

                <div>
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>

                <div>
                    <button class="btn btn-success form-control mt-3" type="submit" 
                    name="loginbtn">Login</button>
                </div>
            </form>
        </div>
        <div class ="mt-3" style="width:500px">
            <?php 
                if (isset($_POST['loginbtn'])){
                    $username = htmlspecialchars($_POST['username']);
                    $password = htmlspecialchars($_POST['password']);

                    $query = mysqli_query($con,"SELECT * FROM users WHERE username='$username'");
                    $countdata = mysqli_num_rows($query);
                    $data = mysqli_fetch_array($query);
                   
                    if($countdata>0){
                        if (password_verify( $password, $data["password"])){
                            $_SESSION["username"] = $data["username"];
                            $_SESSION['login'] = true;
                            header('location: indexx.php');
                        }
                        else{
                            ?>  
                            <div class="alert alert-danger" role="alert">
                                Password Salah
                            </div>
                            <?php
                        }
                }
                else{
                    ?>  
                    <div class="alert alert-warning" role="alert">
                            Akun Tidak Ditemukan
                    </div
                    <?php
                }
            
            }
            ?>
        </div>
    </div>
</body>
</html>