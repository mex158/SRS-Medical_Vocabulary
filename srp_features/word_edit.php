<?php
session_start();

include "connect.php";
$table_name="words_" . $_SESSION["username"];
session_write_close();

$stmt = $conn->prepare("SELECT native, target FROM $table_name ORDER BY native");
$stmt->execute();
$result = $stmt->get_result();
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
        <h1>Word editor</h1>
        <h4>Add or delete words</h4>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <div class="container mt-5">
            <table class="table table-striped">

                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Native</th>
                        <th scope="col">Target</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result) {
                        $show = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        foreach ($show as $row) {
                            $rijec = $row["native"];
                            $prevod = $row["target"];
                    ?>
                            <tr>
                                <th scope="row">x</th>
                                <td><?php echo $rijec ?></td>
                                <td><?php echo $prevod ?></td>
                
                                <td><form action="change_word.php" method="POST"><button title="Edit <?php echo $rijec?>" type="submit" name="<?php echo $rijec ?>">Edit</button></form></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                    
                </tbody>
            </table>
        </div>
        <div class="container">
        
            <a href="add_new.php" class="btn btn-primary w-100">Add new words</a>
        
        </div>

        <div class=mt-5>
        <form action="glavna.php"><button type="submit" class="btn btn-primary">Go back</button></form>
    </div>
    </center>

</body>

</html>