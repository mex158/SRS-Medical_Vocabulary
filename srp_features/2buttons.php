<?php
include "select_randomised.php";

if($tier_r<20){
    $tierx=$tier_r+1;
} else {
    $tierx=$tier_r;
}


$stmt3=$conn->prepare("SELECT * FROM algo WHERE tier=?");
    $stmt3->bind_param("i", $tierx);
    $stmt3->execute();
    $result=$stmt3->get_result();
    if($result){
        $algor=mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach($algor as $row){
            $days_algo=$row["days"];
        }
    }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <form action="card.php" method="POST">
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <button type="submit" name="dont_know" class="btn btn-danger">I didn't know<br><small>&#60;1 min</small></button>
            <button type="submit" name="knew" class="btn btn-success">I knew it<br><small><?php  echo $days_algo ?> days</small></button>
        </div>
    </form>

</body>

</html>