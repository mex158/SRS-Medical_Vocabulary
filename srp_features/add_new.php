<?php

include "connect.php";

if(isset($_POST["native_new"])){
$native_new=$_POST["native_new"];
$target_new=$_POST["target_new"];
session_start();
$table_name="words_" . $_SESSION["username"];
session_write_close();

$stmt=$conn->prepare("INSERT INTO $table_name (native, target) VALUES (?, ?)");

$stmt->bind_param("ss", $native_new, $target_new);
$stmt->execute();
echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
<strong>Success!</strong> You have successfully added a new word.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <center>
        <h1>Add new words</h1>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


        <div class="container mt-5">

            <form action="add_new.php" method="POST">

            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" required name="native_new" placeholder="Native word" aria-label="First name">
                </div>
                <div class="col">
                    <input type="text" class="form-control" required name="target_new" placeholder="Target word" aria-label="Last name">
                </div>
            </div>
            <div class="container mt-2">
            <button type="submit" class="btn btn-primary w-100">Add word</button>
            </div>

            </form>
            
            
        </div>
        <div class="mt-5">
        <form action="word_edit.php"><button type="submit" class="btn btn-primary">Go back</button></form>
    </div>
    </center>


</body>

</html>