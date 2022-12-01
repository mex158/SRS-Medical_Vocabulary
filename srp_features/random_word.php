<?php
session_start();
include "connect.php";
$table_name="words_" . $_SESSION["username"];
session_write_close();

$stmt=$conn->prepare("SELECT native, target, tier FROM $table_name WHERE correct=0 OR (DATE_ADD(date_last, INTERVAL days_repeat SECOND)<NOW()) ORDER BY RAND() LIMIT 1");
$stmt->execute();
$result=$stmt->get_result();
if($result){
    $count=mysqli_num_rows($result);
    if($count>0){
        $show1=mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach($show1 as $show2){
            $word=$show2["native"];
            $trans=$show2["target"];
            $tier=$show2["tier"];
        }
    } else {
        header("location: finished.html");
    }
}
?>

