<?php
$incorrect=false;

if($_SERVER["REQUEST_METHOD"]=="POST") {
    include "srp_features/connect.php";
    $username=$_POST["username"];
    $password=$_POST["password"];
    $sql="SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result=mysqli_query($conn, $sql);
    if ($result) {
        $num=mysqli_num_rows($result);
        if ($num>0) {
          session_start();
            $_SESSION["username"]=$username;
            header("location: srp_features/glavna.php");
            session_write_close();
        } else {
            $incorrect=true;
        }
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Login page</title>
  </head>
  <?php
if ($incorrect) {
    print_r('<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Holy guacamole!</strong> Wrong username or password.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>');
}
?>
  <body>
    <center>
    <h1 class="mt-5">Login page</h1>
    <div class="container mt-5">
    <form action="index.php" method="POST">
    
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Username</label>
        <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
    </div>
    <button type="submit" class="btn btn-primary mt-2 w-100">Login</button>
    </form>
        <div class="container mt-5 text-right">
            Don't have an account?
            <a href="signup.php" class="btn btn-secondary ">Sign up</a>
        </div>
    </div>
    
    </center>
    
  </body>
</html>