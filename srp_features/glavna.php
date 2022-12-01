<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SRS home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <center>
    <h1>Welcome, <?php echo (ucfirst($_SESSION["username"]));
    session_write_close(); ?>!</h1>
        <div class="card mt-5" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Spaced repetition system</h5>
                <p class="card-text">Learn new words by using this great learning method.</p>
                <a href="start_button.php" class="btn btn-primary">Start</a>
            </div>
        </div>
        <div class="container mt-5">
            <a href="word_edit.php" class="btn btn-outline-secondary">Word list</a>
        </div>
        <br>
        <div class="container mt-5">
            <a href="logout.php" class="btn btn-outline-secondary">Logout</a>
        </div>
        
    </center>
</body>

</html>