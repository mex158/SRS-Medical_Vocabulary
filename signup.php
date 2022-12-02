<?php
$user = false;
$no_match = false;



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "srp_features/connect.php";
    $username = $_POST["username"];
    $password = $_POST["password"];
    $rep_password = $_POST["password1"];

    if ($password == $rep_password) {
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $num = mysqli_num_rows($result);
            if ($num > 0) {
                $user = true;
            } else {
                $table_name = "words_" . $username;
                $rand_name = "rando_" . $username;
                $sql = "INSERT INTO users (username, password) VALUES ('$username','$password')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $stmt = $conn->prepare("CREATE TABLE $table_name (
                        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        native VARCHAR(150) NOT NULL,
                        target VARCHAR(150) NOT NULL,
                        date_last DATE DEFAULT current_timestamp(),
                        tier INT(3) DEFAULT -1,
                        days_repeat INT(3) DEFAULT 0,
                        correct TINYINT DEFAULT 0)");
                    
                    
                    
                    $stmt->execute();


                    $stmt = $conn->prepare("CREATE TABLE $rand_name (
                        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        native VARCHAR(150) NOT NULL,
                        target VARCHAR(150) NOT NULL,
                        tier INT(3) DEFAULT -1)");
                    $stmt->execute();
                    $stmt->prepare("INSERT INTO $rand_name (native, target) VALUES ('empty_native', 'empty_target')");
                    $stmt->execute();
                    header("location: index.php");
                } else {
                    die(mysqli_error($conn));
                }
            }
        }
    } else {
        $no_match = true;
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

    <title>Signup page</title>
</head>
<?php
if ($no_match) {
    print_r('<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong> Passwords do not match!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>');
}
if ($user) {
    print_r('<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>User already exist!</strong> Please choose another username.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>');
}
?>

<body>
    <center>
        <h1 class="mt-5">Signup page</h1>
        <div class="container mt-5">
            <form action="signup.php" method="POST">

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" name="username" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Repeat password</label>
                    <input type="password" name="password1" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary mt-2 w-100">Submit</button>
            </form>
            <div class="container mt-5 text-right">
                Already have an account?
                <a href="index.php" class="btn btn-secondary ">Log in</a>
            </div>
        </div>

    </center>

</body>

</html>